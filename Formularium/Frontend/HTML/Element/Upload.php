<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Formularium\Frontend\HTML\Framework;

class Upload extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $id = 'upload' . Framework::counter();
        return HTMLNode::factory(
            'div',
            [
                'class' => 'formularium-upload'
            ],
            [
                HTMLNode::factory(
                    'label',
                    [
                        'class' => 'formularium-label',
                        'for' => $id
                    ],
                    $parameters[self::LABEL] ?? 'Upload file'
                ),
                HTMLNode::factory(
                    'input',
                    [
                        'id' => $id,
                        'class' => 'formularium-input',
                        'type' => 'file'
                    ]
                ),
                HTMLNode::factory(
                    'div',
                    ['class' => 'formularium-comment'],
                    $parameters[self::COMMENT] ?? ''
                )
            ]
        );
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Upload',
            'Creates an upload field',
            [
                new MetadataParameter(
                    static::LABEL,
                    'string',
                    'Label for this upload field'
                ),
                new MetadataParameter(
                    static::COMMENT,
                    'string',
                    'Comment for this upload field'
                ),
            ]
        );
    }
}
