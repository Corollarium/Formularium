<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_bool;
use Formularium\Datatype\Datatype_number;
use Formularium\Exception\Exception;
use Formularium\FrameworkComposer;
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

    protected function getContainerAttributes(Model $m): array
    {
        // TODO: this replicates code from HTML::Framework. See if there's a cleaner way to handle this.
        $atts = [
            'class' => 'formularium-base'
        ];
        $schemaItemScope = $this->getOption('itemscope', $m->getRenderable('itemscope', false));
        if ($schemaItemScope) {
            $atts['itemscope'] = '';
        }
        $schemaItemType = $this->getOption('itemtype', $m->getRenderable('itemtype', null));
        if ($schemaItemType) {
            $atts['itemtype'] = $schemaItemType;
            $atts['itemscope'] = '';
        }
        return $atts;
    }

    /**
     * Collapses an array into a HTML list of attributes. Not particularly
     * safe function, but data goes through htmlspecialchars()
     *
     * @param array $f
     * @return string
     */
    protected function collapseHTMLAttributes(array $f): string
    {
        $x = [];
        foreach ($f as $k => $v) {
            $x[] = htmlspecialchars($k) . '="' . htmlspecialchars($v) . '"';
        }
        return join(' ', $x);
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

    public function viewableCompose(Model $m, array $elements, string $previousCompose, FrameworkComposer $frameworkComposer): string
    {
        $containerAtts = $this->getContainerAttributes($m);
        $templateData = [
            'containerTag' => $this->getViewableContainerTag(),
            'containerAtts' => $this->collapseHTMLAttributes($containerAtts),
            'form' => join('', $elements),
            'script' => $this->vueCode->toScript($m, $elements)
        ] + $this->vueCode->renderer->getTemplateData($m, $elements);

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
<{{containerTag}} {{containerAtts}}>
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
            $id = 'vueapp' . static::counter();
            $containerAtts['id'] = $id;
            $t = new HTMLNode(
                $templateData['containerTag'],
                $containerAtts,
                $templateData['form'],
                true
            );
            $this->vueCode->appendOther('el', "'#$id'");
            $vars = $this->vueCode->toVariable($m, $elements);
            $script = "const app_$id = new Vue({{$vars}});";
            $s = new HTMLNode('script', [], $script, true);
            return HTMLNode::factory('div', [], [$t, $s])->getRenderHTML();
        }
    }

    public function editableCompose(Model $m, array $elements, string $previousCompose, FrameworkComposer $frameworkComposer): string
    {
        $containerAtts = $this->getContainerAttributes($m);

        $templateData = [
            'containerTag' => $this->getEditableContainerTag(),
            'containerAtts' => $this->collapseHTMLAttributes($containerAtts),
            'form' => join('', $elements),
            'script' => $this->vueCode->toScript($m, $elements),
        ] + $this->vueCode->renderer->getTemplateData($m, $elements);

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
<{{containerTag}} {{containerAtts}}>
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
            $containerAtts['id'] = $id;
            $t = new HTMLNode(
                $templateData['containerTag'],
                $containerAtts,
                $templateData['form'],
                true
            );
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
