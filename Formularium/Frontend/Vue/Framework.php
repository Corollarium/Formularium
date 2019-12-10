<?php

namespace Formularium\Frontend\Vue;

use Formularium\HTMLElement;

class Framework extends \Formularium\Framework
{
    const VUE_MODE_SINGLE_FILE = 'VUE_MODE_SINGLE_FILE';
    const VUE_MODE_EMBEDDED = 'VUE_MODE_EMBEDDED';

    /**
     * @var string
     */
    protected $mode;

    public function __construct(string $name = 'Vue')
    {
        parent::__construct($name);
        $this->mode = self::VUE_MODE_EMBEDDED;
    }

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
        return join('', $elements); // TODO
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        $data = [];
        foreach ($m->getFields() as $name => $field) {
            $data[$name] = $field->getDatatype()->getDefault();
        }

        $editableForm = join('', $elements);
        $jsonData = json_encode($data);

        if ($this->mode === self::VUE_MODE_SINGLE_FILE) {
            return <<<EOF
<template>
<div>
    $editableForm
</div>
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
            $t = new HTMLElement('div', ['id' => $id], $editableForm, true);
            $script = <<<EOF
            console.log("asdfasd");
var app = new Vue({
    el: '#$id',
    data: $jsonData
});
console.log(app);
EOF;
            $s = new HTMLElement('script', [], $script, true);
            return HTMLElement::factory('div', [], [$t, $s])->getRenderHTML();
        }
    }
}
