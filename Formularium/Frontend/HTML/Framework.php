<?php

namespace Formularium\Frontend\HTML;

class Framework extends \Formularium\Framework
{
    public function __construct($name = 'HTML')
    {
        parent::__construct($name);
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return join('', $elements);
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return join('', $elements);
    }
}
