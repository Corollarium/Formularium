<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy;

use Formularium\HTMLElement;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Buefy')
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
                    'href' => "https://unpkg.com/buefy/dist/buefy.min.css",
                ]
            )
        )->appendContent(
            HTMLElement::factory(
                'script',
                [
                    'src' => "https://unpkg.com/buefy/dist/buefy.min.js",
                ]
            )
        )->appendContent(
            HTMLElement::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://use.fontawesome.com/releases/v5.2.0/css/all.css",
                ]
            )
        );
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return $previousCompose;
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return $previousCompose;
    }
}
