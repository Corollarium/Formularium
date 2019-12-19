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
            if ($field->getExtension('VUEPROP')) { // TODO
                $p = [
                    'type' => $this->mapType($field->getDatatype()),
                ];
                if ($field->getExtension(Datatype::REQUIRED)) {
                    $p['required'] = true;
                }
                $props[$field->getName()] = $p;
            }
        }
        return $props;
    }

    public function viewableCompose(Model $m, array $elements, string $previousCompose): string
    {
        $data = $m->getDefault(); // TODO: load data
        
        $viewableForm = join('', $elements);
        $jsonData = json_encode($data);
        $templateData = [
            'containerTag' => $this->getViewableContainerTag(),
            'form' => $viewableForm,
            'jsonData' => $jsonData,
            'props' => $this->props($m)
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
            $id = 'vueapp';
            $t = new HTMLElement(self::getViewableContainerTag(), ['id' => $id], $viewableForm, true);
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
        $data = $m->getDefault(); // TODO: load data
        $editableContainerTag = $this->getEditableContainerTag();
        $editableForm = join('', $elements);
        $jsonData = json_encode($data);
        $templateData = [
            'containerTag' => $this->getViewableContainerTag(),
            'form' => $editableForm,
            'jsonData' => $jsonData,
            'props' => $this->props($m)
        ];

        if ($this->viewableTemplate) {
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
            $id = 'vueapp';
            $t = new HTMLElement($editableContainerTag, ['id' => $id], $editableForm, true);
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

    protected function fillTemplate(string $template, array $data, Model $m): string
    {
        $template = str_replace(
            '{{form}}',
            $data['form'],
            $template
        );
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
        $template = str_replace(
            '{{jsonData}}',
            $data['jsonData'],
            $template
        );
        $template = str_replace(
            '{{containerTag}}',
            $data['containerTag'],
            $template
        );
        return $template;
    }
}
