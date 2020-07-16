<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;

class Badge extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $node = new HTMLNode('span');

        $node->setAttributes([
            'class' => 'formularium-badge',
        ]);

        $node->setContent($parameters[self::LABEL]);

        return $node;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Badge',
            'Creates a badge field',
            [
            ]
        );
    }
}
