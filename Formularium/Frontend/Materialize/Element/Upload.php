<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\Frontend\HTML\Element\Upload as HTMLUpload;

class Upload extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        return HTMLNode::factory(
            'div',
            [
                'class' => 'formularium-upload file-field input-field'
            ],
            [
                HTMLNode::factory(
                    'div',
                    [
                        'class' => 'btn',
                    ],
                    [
                        HTMLNode::factory(
                            'span',
                            [
                                'class' => 'formularium-label',
                            ],
                            $parameters[self::LABEL] ?? 'File'
                        ),
                        HTMLNode::factory(
                            'input',
                            [
                                'class' => 'formularium-input',
                                'type' => 'file'
                            ]
                        ),
                    ]
                ),
                HTMLNode::factory(
                    'div',
                    ['class' => 'file-path-wrapper'],
                    HTMLNode::factory(
                        'input',
                        [
                            'class' => 'file-path validate',
                            'type' => 'text'
                        ]
                    )
                )
            ]
        );
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLUpload::getMetadata();
        return $metadata;
    }
}
