<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Formularium\Frontend\HTML\Framework;

class Spinner extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        return HTMLNode::factory(
            'button',
            [
                'class' => 'button is-loading',
                'disabled'
            ]
        );
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Spinner',
            'Creates a spinner',
            [
            ]
        );
    }
}
