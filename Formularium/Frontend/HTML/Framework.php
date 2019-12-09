<?php

namespace Formularium\Frontend\HTML;

class Framework extends \Formularium\Framework
{
    public static function counter()
    {
        static $counter = 0;
        return $counter++;
    }

    public function __construct(string $name = 'HTML')
    {
        parent::__construct($name);
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return join('', array_map(function ($e) {
            return $e->__toString();
        }, $elements));
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return join('', array_map(function ($e) {
            return $e->__toString();
        }, $elements));
    }
}
