<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_bool;
use Formularium\Datatype\Datatype_number;
use Formularium\HTMLNode;
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
     * @var string|callable|null
     */
    protected $viewableTemplate = null;

    /**
     *
     *
     * @var string|callable|null
     */
    protected $editableTemplate = null;

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
     * @return string|callable|null
     */
    public function getEditableTemplate()
    {
        return $this->editableTemplate;
    }

    /**
     * Set the value of editableTemplate
     *
     * @param string|callable|null $editableTemplate
     * @return self
     */
    public function setEditableTemplate($editableTemplate): Framework
    {
        $this->editableTemplate = $editableTemplate;

        return $this;
    }
    
    /**
     * Get viewable template
     *
     * @return string|callable|null
     */
    public function getViewableTemplate()
    {
        return $this->viewableTemplate;
    }

    /**
     * Set viewable tempalte
     *
     * @param string|callable|null  $viewableTemplate
     *
     * @return  self
     */
    public function setViewableTemplate($viewableTemplate)
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

    public function htmlHead(HTMLNode &$head)
    {
        $head->prependContent(
            HTMLNode::factory('script', ['src' => "https://cdn.jsdelivr.net/npm/vue/dist/vue.js"])
        );
    }

    public function mapType(Datatype $type): string
    {
        if ($type instanceof Datatype_number) {
            return 'Number';
        } elseif ($type instanceof Datatype_bool) {
            return 'Boolean';
        }
        return 'String';
    }

    public function props(Model $m): array
    {
        $props = [];
        foreach ($m->getFields() as $field) {
            if ($field->getRenderable(self::VUE_PROP, true)) { // TODO
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
            'props' => $props,
            'propsCode' => $this->serializeProps($props),
            'propsBind' => implode(' ', $propsBind)
        ];

        if (is_callable($this->viewableTemplate)) {
            return call_user_func(
                $this->viewableTemplate,
                $this,
                $templateData,
                $m
            );
        } elseif ($this->mode === self::VUE_MODE_SINGLE_FILE) {
            $viewableTemplate = $this->viewableTemplate ? $this->viewableTemplate : <<<EOF
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
    methods: {
    }
};
</script>
<style>
</style>
EOF;
            
            return $this->fillTemplate(
                $viewableTemplate,
                $templateData,
                $m
            );
        } else {
            $id = 'vueapp' . static::counter();
            $t = new HTMLNode($this->getViewableContainerTag(), ['id' => $id], $viewableForm, true);
            $script = <<<EOF
const app_$id = new Vue({
    el: '#$id',
    data: $jsonData
});
EOF;
            $s = new HTMLNode('script', [], $script, true);
            return HTMLNode::factory('div', [], [$t, $s])->getRenderHTML();
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
            'props' => $props,
            'propsCode' => $this->serializeProps($props),
            'propsBind' => implode(' ', $propsBind),
            'methods' => [
                'changedFile' => <<<EOF
changedFile(name, event) {
    console.log(name, event);
    const input = event.target;
    const files = input.files;
    if (files && files[0]) {
        // input.preview = window.URL.createObjectURL(files[0]);
    }
}
EOF
            ]
        ];

        if (is_callable($this->editableTemplate)) {
            return call_user_func(
                $this->editableTemplate,
                $this,
                $templateData,
                $m
            );
        } elseif ($this->editableTemplate) {
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
    props: {
        {{propsCode}}
    },
    methods: {
        {{methods}}
    }
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
            $t = new HTMLNode($editableContainerTag, ['id' => $id], $editableForm, true);
            $script = <<<EOF
const app_$id = new Vue({
    el: '#$id',
    data: function () {
        return $jsonData;
    },
    methods: {
        {{methods}}
    }
});
EOF;
            $s = new HTMLNode('script', [], $script, true);
            return HTMLNode::factory('div', [], [$t, $s])->getRenderHTML();
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
