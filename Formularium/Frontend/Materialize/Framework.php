<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize;

use Formularium\FrameworkComposer;
use Formularium\HTMLNode;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Materialize')
    {
        parent::__construct($name);
    }

    public function htmlHead(HTMLNode &$head)
    {
        $head->appendContent(
            HTMLNode::factory('meta', ['name' => "viewport", 'content' => "width=device-width, initial-scale=1"])
        )->appendContent(
            HTMLNode::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
                ]
            )
        );
    }

    public function htmlFooter(HTMLNode &$footer)
    {
        $footer->appendContent(
            HTMLNode::factory('script', ['src' => "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"])
        );
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose, FrameworkComposer $composer): string
    {
        return '<section class="section"><div class="container">' . $previousCompose . '</div></section>';
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose, FrameworkComposer $composer): string
    {
        return '<section class="section"><div class="container">' . $previousCompose . '</div></section>';
    }
}
