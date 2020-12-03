<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_bool;
use Formularium\Datatype\Datatype_number;
use Formularium\Exception\Exception;
use Formularium\HTMLNode;
use Formularium\Model;

class Framework extends \Formularium\Framework
{
    const VUE_MODE_SINGLE_FILE = 'VUE_MODE_SINGLE_FILE';
    const VUE_MODE_EMBEDDED = 'VUE_MODE_EMBEDDED';
    const VUE_PROP = 'VUE_PROP';
    const VUE_VARS = 'VUE_VARS';
    const VUE_CODE = 'VUE_CODE';

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
     * {{script}}
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

    /**
     * Appended to the field variable names to handle models stored in an object field.
     *
     * Allows you to declare the model like this:
     *
     * data() {
     *   return {
     *       model: model,
     *   };
     * },
     *
     * @var string
     */
    protected $fieldModelVariable = '';

    /**
     * @var VueCode
     */
    protected $vueCode = null;

    public function __construct(string $name = 'Vue')
    {
        parent::__construct($name);
        $this->vueCode = new VueCode();
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
            [
                HTMLNode::factory('script', ['src' => "https://vuejs.org/js/vue.js"]),
                HTMLNode::factory('script', [], 'Vue.config.devtools = true')
            ]
        );
    }

    public function viewableCompose(Model $m, array $elements, string $previousCompose): string
    {
        $templateData = [
            'containerTag' => $this->getViewableContainerTag(),
            'form' => join('', $elements),
            'script' => $this->vueCode->toScript($m, $elements)
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
{{{script}}}
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
            // TODO: this is likely broken
            $id = 'vueapp' . static::counter();
            $t = new HTMLNode($this->getViewableContainerTag(), ['id' => $id], $templateData['form'], true);
            $vars = $this->vueCode->toVariable($m, $elements);
            $this->vueCode->appendOther('el', "#$id");
            $script = "const app_$id = new Vue({$vars});";
            $s = new HTMLNode('script', [], $script, true);
            return HTMLNode::factory('div', [], [$t, $s])->getRenderHTML();
        }
    }

    public function editableCompose(Model $m, array $elements, string $previousCompose): string
    {
        $templateData = [
            'containerTag' => $this->getEditableContainerTag(),
            'form' => join('', $elements),
            'script' => $this->vueCode->toScript($m, $elements)
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
{{{script}}}
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
            $t = new HTMLNode($templateData['containerTag'], ['id' => $id], $templateData['form'], true);
            $this->vueCode->appendOther('el', "'#$id'");
            $vars = $this->vueCode->toVariable($m, $elements);
            $script = "const app_$id = new Vue({{$vars}});";
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

    /**
     * Get appended to the field variable names to handle models stored in an object field.
     *
     * @return  string
     */
    public function getFieldModelVariable(): string
    {
        return $this->fieldModelVariable;
    }

    /**
     * Set appended to the field variable names to handle models stored in an object field.
     *
     * @param  string  $fieldModelVariable  Appended to the field variable names to handle models stored in an object field.
     *
     * @return  self
     */
    public function setFieldModelVariable(string $fieldModelVariable): self
    {
        $this->fieldModelVariable = $fieldModelVariable;

        return $this;
    }

    /**
     * Get the value of vueCode
     *
     * @return  VueCode
     */
    public function getVueCode()
    {
        return $this->vueCode;
    }

    public function resetVueCode(): void
    {
        $this->vueCode = new VueCode();
    }
}
