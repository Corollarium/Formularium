<?php

namespace Formularium\Frontend\Vue;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Vue')
    {
        parent::__construct($name);
    }
    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        $data = [];
        foreach ($m->getFields() as $f) {
            $values = ''; // TODO: values?
            $data[] = $f->viewable($values);
        }
        return join('', $data);
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        $data = [];
        foreach ($m->getFields() as $name => $field) {
            $data[$name] = $field->getDatatype()->getDefault();
        }

        $editableForm = join('', $elements);
        $jsonData = json_encode($data);

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
    }
}
