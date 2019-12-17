<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\HTMLElement;

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
    protected static $viewableContainerTag = 'div';

    /**
     * The tag used as container for fields in editable()
     *
     * @var string
     */
    protected static $editableContainerTag = 'div';


    public function __construct(string $name = 'Vue')
    {
        parent::__construct($name);
    }

    public static function getViewableContainerTag(): string
    {
        return static::$viewableContainerTag;
    }
    
    /**
     * @param string $tag
     * @return void
     */
    public static function setViewableContainerTag(string $tag)
    {
        static::$viewableContainerTag = $tag;
    }

    public static function getEditableContainerTag(): string
    {
        return static::$editableContainerTag;
    }
    
    /**
     * @param string $tag
     * @return void
     */
    public static function setEditableContainerTag(string $tag)
    {
        static::$editableContainerTag = $tag;
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

    public function htmlHead(HTMLElement &$head)
    {
        $head->prependContent(
            HTMLElement::factory('script', ['src' => "https://cdn.jsdelivr.net/npm/vue/dist/vue.js"])
        );
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        $data = $m->getDefault(); // TODO: load data
        $viewableContainerTag = static::getViewableContainerTag();
        $viewableForm = join('', $elements);
        $jsonData = json_encode($data);

        if ($this->mode === self::VUE_MODE_SINGLE_FILE) {
            return <<<EOF
<template>
<$viewableContainerTag>
    $viewableForm
</$viewableContainerTag>
</template>
<script>
module.exports = {
    data: function () {
        return $jsonData;
    }
};
</script>
<style>
</style>
EOF;
        } else {
            $id = 'vueapp';
            $t = new HTMLElement($viewableContainerTag, ['id' => $id], $viewableForm, true);
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

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        $data = $m->getDefault(); // TODO: load data
        $editableContainerTag = static::getEditableContainerTag();
        $editableForm = join('', $elements);
        $jsonData = json_encode($data);

        if ($this->mode === self::VUE_MODE_SINGLE_FILE) {
            return <<<EOF
<template>
<$editableContainerTag>
    $editableForm
</$editableContainerTag>
</template>
<script>
module.exports = {
    data: function () {
        return $jsonData;
    },

    methods: {
        loadAssociations() {
            window.axios.get('/api/cruds').then(({ data }) => {
                // console.log(data)
            });
        }
    }
};
</script>
<style>
</style>
EOF;
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
}
