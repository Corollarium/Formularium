<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\Frontend\HTML\Element\Upload as HTMLUpload;
use Formularium\Frontend\HTML\Framework as HTMLFramework;

class Upload extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $id = 'upload' . HTMLFramework::counter();
        return HTMLNode::factory(
            'div',
            [
                'class' => 'formularium-upload file'
            ],
            [
                HTMLNode::factory(
                    'label',
                    [
                        'class' => 'formularium-label file-label',
                        'for' => $id
                    ],
                    [
                        HTMLNode::factory(
                            'input',
                            [
                                'id' => $id,
                                'class' => 'formularium-input file-input',
                                'type' => 'file'
                            ]
                        ),
                        HTMLNode::factory(
                            'span',
                            ['class' => 'file-cta'],
                            [
                                HTMLNode::factory(
                                    'span',
                                    ['class' => 'file-icon'],
                                    HTMLNode::factory(
                                        'i',
                                        ['class' => 'fas fa-upload']
                                    )
                                ),
                                HTMLNode::factory(
                                    'span',
                                    ['class' => 'file-label'],
                                    $parameters[self::LABEL] ?? 'Upload file'
                                )
                            ]
                        )
                    ]
                ),
            ]
        );
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLUpload::getMetadata();
        return $metadata;
    }
}
