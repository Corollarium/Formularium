<?php

namespace Formularium\Frontend\Bootstrap;

use Formularium\HTMLElement;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Bootstrap')
    {
        parent::__construct($name);
    }

    public function htmlHead(HTMLElement &$head)
    {
        $head->appendContent(
            HTMLElement::factory('meta', ['name' => "viewport", 'content' => "width=device-width, initial-scale=1"])
        )->appendContent(
            HTMLElement::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",
                    'integrity' => "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm",
                    'crossorigin' => "anonymous"
                ]
            )
        );
    }

    public function htmlFooter(HTMLElement &$footer)
    {
        $footer->appendContent([
            HTMLElement::factory('script', ['src' => "https://code.jquery.com/jquery-3.2.1.slim.min.js", 'integrity' => "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN", 'crossorigin' => "anonymous"]),
            HTMLElement::factory('script', ['src' => "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js", 'integrity' => "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q", 'crossorigin' => "anonymous"]),
            HTMLElement::factory('script', ['src' => "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js", 'integrity' => "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl", 'crossorigin' => "anonymous"])
        ]);
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
