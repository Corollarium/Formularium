<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue;

use Formularium\FrameworkComposer;
use Formularium\HTMLNode;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Bootstrapvue')
    {
        parent::__construct($name);
    }

    public function htmlHead(HTMLNode &$head)
    {
        $head->appendContent(
            HTMLNode::factory('meta', ['name' => "viewport", 'content' => "width=device-width, initial-scale=1, shrink-to-fit=no"])
        )->appendContent(
            HTMLNode::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://unpkg.com/bootstrap/dist/css/bootstrap.min.css",
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css",
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'script',
                [
                    'src' => "https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js",
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
        );
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose, FrameworkComposer $composer): string
    {
        return $previousCompose;
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose, FrameworkComposer $composer): string
    {
        return $previousCompose;
    }
}
