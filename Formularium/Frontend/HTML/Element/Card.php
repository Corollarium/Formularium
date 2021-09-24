<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Card extends Element
{
    const IMAGE = "image";
    const LINK = "link";
    const CONTENT = "content";

    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Card',
            'Creates a card',
            [
                new MetadataParameter(
                    static::TITLE,
                    'string',
                    'Card title.'
                ),
                new MetadataParameter(
                    static::IMAGE,
                    'string',
                    'Card image.'
                ),
                new MetadataParameter(
                    static::LINK,
                    'string',
                    'Card link'
                )
            ]
        );
    }
}
