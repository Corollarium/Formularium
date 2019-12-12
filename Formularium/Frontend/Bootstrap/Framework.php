<?php declare(strict_types=1);

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
                    'href' => "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css",
                    'integrity' => "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh",
                    'crossorigin' => "anonymous"
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

    public function htmlFooter(HTMLElement &$footer)
    {
        $footer->appendContent([
            HTMLElement::factory('script', ['src' => "https://code.jquery.com/jquery-3.4.1.slim.min.js", 'integrity' => "sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n", 'crossorigin' => "anonymous"]),
            HTMLElement::factory('script', ['src' => "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js", 'integrity' => "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo", 'crossorigin' => "anonymous"]),
            HTMLElement::factory('script', ['src' => "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js", 'integrity' => "sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6", 'crossorigin' => "anonymous"])
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
