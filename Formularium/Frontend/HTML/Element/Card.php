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
            'Table',
            'Creates a table',
            [
                new MetadataParameter(
                    static::TITLE,
                    'array',
                    'Is it disabled?'
                ),
                new MetadataParameter(
                    static::IMAGE,
                    'bool',
                    'Is this table striped?'
                ),
                new MetadataParameter(
                    static::LINK,
                    'bool',
                    'Is this table bordered?'
                )
            ]
        );
    }
}
