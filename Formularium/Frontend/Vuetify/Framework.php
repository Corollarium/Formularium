<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue;

use Formularium\HTMLNode;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Vuetify')
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
                    'href' => "https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css",
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css",
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'script',
                [
                    'src' => "https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js",
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
