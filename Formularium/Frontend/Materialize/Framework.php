<?php

namespace Formularium\Frontend\Materialize;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Materialize')
    {
        parent::__construct($name);
    }

    public function htmlHead(): string
    {
        return '<meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">';
    }

    public function htmlFooter(): string
    {
        return '<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>';
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return '<section class="section"><div class="container">' . $previousCompose . '</div></section>';
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return '<section class="section"><div class="container">' . $previousCompose . '</div></section>';
    }
}
