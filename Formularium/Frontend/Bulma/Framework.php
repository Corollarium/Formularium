<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma;

use Formularium\FrameworkComposer;
use Formularium\HTMLNode;

class Framework extends \Formularium\Frontend\HTML\Framework
{
    public function __construct(string $name = 'Bulma')
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
                    'href' => "https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css",
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'script',
                ['defer' => null, 'src' => "https://use.fontawesome.com/releases/v5.3.1/js/all.js"]
            )
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
