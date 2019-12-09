<?php

namespace Formularium\Frontend\Bulma;

class Framework extends \Formularium\Frontend\HTML\Framework
{
    public function __construct(string $name = 'Bulma')
    {
        parent::__construct($name);
    }

    public function htmlHead(): string
    {
        return '<meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">';
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
