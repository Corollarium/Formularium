<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy;

use Formularium\HTMLNode;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Buefy')
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
                    'href' => "https://unpkg.com/buefy/dist/buefy.min.css",
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'script',
                [
                    'src' => "https://unpkg.com/buefy/dist/buefy.min.js",
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://use.fontawesome.com/releases/v5.2.0/css/all.css",
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css",
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
