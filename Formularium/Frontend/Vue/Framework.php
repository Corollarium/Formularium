<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_bool;
use Formularium\Datatype\Datatype_number;
use Formularium\HTMLElement;
use Formularium\Model;

class Framework extends \Formularium\Framework
{
    const VUE_MODE_SINGLE_FILE = 'VUE_MODE_SINGLE_FILE';
    const VUE_MODE_EMBEDDED = 'VUE_MODE_EMBEDDED';

    const VUE_PROP = 'VUE_PROP';

    const VUE_VARS = 'VUE_VARS';

    /**
     * @var string
     */
    protected $mode = self::VUE_MODE_EMBEDDED;

    /**
    * The tag used as container for fields in viewable()
    *
    * @var string
    */
    protected $viewableContainerTag = 'div';

    /**
     * The tag used as container for fields in editable()
     *
     * @var string
     */
    protected $editableContainerTag = 'div';

    /**
     * The viewable template.
     *
     * The following variables are replaced:
     *
     * {{form}}
     * {{jsonData}}
     * {{containerTag}}
     *
     * @var string
     */
    protected $viewableTemplate = '';

    /**
     *
     *
     * @var string
     */
    protected $editableTemplate = '';

    public function __construct(string $name = 'Vue')
    {
        parent::__construct($name);
    }

    /**
     * Static counter to generate unique ids.
     *
     * @return integer
     */
    public static function counter(): int
    {
        static $counter = 0;
        return $counter++;
    }

    /**
     * Get the tag used as container for fields in viewable()
     *
     * @return  string
     */
    public function getViewableContainerTag(): string
    {
        return $this->viewableContainerTag;
    }

    /**
     * Set the tag used as container for fields in viewable()
     *
     * @param  string  $viewableContainerTag  The tag used as container for fields in viewable()
     *
     * @return  self
     */
    public function setViewableContainerTag(string $viewableContainerTag): Framework
    {
        $this->viewableContainerTag = $viewableContainerTag;
        return $this;
    }

    public function getEditableContainerTag(): string
    {
        return $this->editableContainerTag;
    }
    
    /**
     * @param string $tag
     * @return self
     */
    public function setEditableContainerTag(string $tag): Framework
    {
        $this->editableContainerTag = $tag;
        return $this;
    }

    /**
     * Get the value of editableTemplate
     */
    public function getEditableTemplate(): string
    {
        return $this->editableTemplate;
    }

    /**
     * Set the value of editableTemplate
     *
     * @return self
     */
    public function setEditableTemplate(string $editableTemplate): Framework
    {
        $this->editableTemplate = $editableTemplate;

        return $this;
    }
    
    /**
     * Get {{containerTag}}
     *
     * @return  string
     */
    public function getViewableTemplate()
    {
        return $this->viewableTemplate;
    }

    /**
     * Set {{containerTag}}
     *
     * @param  string  $viewableTemplate  {{containerTag}}
     *
     * @return  self
     */
    public function setViewableTemplate(string $viewableTemplate)
    {
        $this->viewableTemplate = $viewableTemplate;

        return $this;
    }
    
    /**
     * Sets the vue render mode, single file component or embedded
     *
     * @param string $mode self::VUE_MODE_EMBEDDED or self::VUE_MODE_SINGLE_FILE
     * @return Framework
     */
    public function setMode(string $mode): Framework
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Get the value of mode
     *
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    public function htmlHead(HTMLElement &$head)
    {
        $head->prependContent(
            HTMLElement::factory('script', ['src' => "https://cdn.jsdelivr.net/npm/vue/dist/vue.js"])
        );
    }

    protected function mapType(Datatype $type): string
    {
        if ($type instanceof Datatype_number) {
            return 'Number';
        } elseif ($type instanceof Datatype_bool) {
            return 'Boolean';
        }
        return 'String';
    }

    protected function props(Model $m): array
    {
        $props = [];
        foreach ($m->getFields() as $field) {
            if ($field->getRenderable(self::VUE_PROP, false)) { // TODO
                $p = [
                    'type' => $this->mapType($field->getDatatype()),
                ];
                if ($field->getRenderable(Datatype::REQUIRED, false)) {
                    $p['required'] = true;
                }
                $props[$field->getName()] = $p;
            }
        }
        return $props;
    }

    protected function serializeProps(array $props): string
    {
        $s = array_map(function ($name, $p) {
            return "'$name': { 'type': {$p['type']}" . ($p['required'] ?? false ? ", 'required': true" : '') . " } ";
        }, array_keys($props), $props);
        return "{\n        " . implode(",\n        ", $s) . "\n    }\n";
    }

    public function viewableCompose(Model $m, array $elements, string $previousCompose): string
    {
        $data = array_merge($m->getDefault(), $m->getData());
        $viewableForm = join('', $elements);
        $jsonData = json_encode($data);
        $props = $this->props($m);
        $propsBind = array_map(
            function ($p) {
                return 'v-bind:' . $p . '="model.' . $p . '"';
            },
            array_keys($props)
        );
        $templateData = [
            'containerTag' => $this->getViewableContainerTag(),
            'form' => $viewableForm,
            'jsonData' => $jsonData,
            'props' => $this->serializeProps($props),
            'propsBind' => implode(' ', $propsBind)
        ];

        if ($this->viewableTemplate) {
            return $this->fillTemplate(
                $this->viewableTemplate,
                $templateData,
                $m
            );
        } elseif ($this->mode === self::VUE_MODE_SINGLE_FILE) {
            $viewableTemplate = <<<EOF
<template>
<{{containerTag}}>
    {{form}}
</{{containerTag}}>
</template>
<script>
module.exports = {
    data: function () {
        return {{jsonData}};
    }
};
</script>
<style>
</style>
EOF;
            return $this->fillTemplate(
                $this->viewableTemplate,
                $templateData,
                $m
            );
        } else {
            $id = 'vueapp' . static::counter();
            $t = new HTMLElement($this->getViewableContainerTag(), ['id' => $id], $viewableForm, true);
            $script = <<<EOF
var app = new Vue({
    el: '#$id',
    data: $jsonData
});
EOF;
            $s = new HTMLElement('script', [], $script, true);
            return HTMLElement::factory('div', [], [$t, $s])->getRenderHTML();
        }
    }

    public function editableCompose(Model $m, array $elements, string $previousCompose): string
    {
        $data = array_merge($m->getDefault(), $m->getData());
        $editableContainerTag = $this->getEditableContainerTag();
        $editableForm = join('', $elements);
        $jsonData = json_encode($data);
        $props = $this->props($m);
        $propsBind = array_map(
            function ($p) {
                return 'v-bind:' . $p . '="model.' . $p . '"';
            },
            array_keys($props)
        );
        $templateData = [
            'containerTag' => $editableContainerTag,
            'form' => $editableForm,
            'jsonData' => $jsonData,
            'props' => $this->serializeProps($props),
            'propsBind' => implode(' ', $propsBind)
        ];

        $methods = <<<EOF
    methods: {
        changedFile(name, event) {
            console.log(name, event);
            const input = event.target;
            const files = input.files;
            if (files && files[0]) {
                // input.preview = window.URL.createObjectURL(files[0]);
            }
        }
    }        
EOF;

        if ($this->editableTemplate) {
            return $this->fillTemplate(
                $this->editableTemplate,
                $templateData,
                $m
            );
        } elseif ($this->mode === self::VUE_MODE_SINGLE_FILE) {
            $editableTemplate = <<<EOF
<template>
<{{containerTag}}>
    {{form}}
</{{containerTag}}>
</template>
<script>
module.exports = {
    data: function () {
        return {{jsonData}};
    },
    $methods
};
</script>
<style>
</style>
EOF;
            return $this->fillTemplate(
                $editableTemplate,
                $templateData,
                $m
            );
        } else {
            $id = 'vueapp' . static::counter();
            $t = new HTMLElement($editableContainerTag, ['id' => $id], $editableForm, true);
            $script = <<<EOF
var app = new Vue({
    el: '#$id',
    data: function () {
        return $jsonData;
    },
    $methods
});
EOF;
            $s = new HTMLElement('script', [], $script, true);
            return HTMLElement::factory('div', [], [$t, $s])->getRenderHTML();
        }
    }

    protected function fillTemplate(string $template, array $data, Model $m): string
    {
        foreach ($data as $name => $value) {
            $template = str_replace(
                '{{' . $name . '}}',
                $value,
                $template
            );
        }

        $template = str_replace(
            '{{modelName}}',
            $m->getName(),
            $template
        );
        $template = str_replace(
            '{{modelNameLower}}',
            mb_strtolower($m->getName()),
            $template
        );
        return $template;
    }
}
