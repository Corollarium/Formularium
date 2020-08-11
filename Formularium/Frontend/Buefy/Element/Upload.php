<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Upload as HTMLUpload;
use Formularium\Frontend\HTML\Framework as HTMLFramework;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Upload extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $id = 'upload' . HTMLFramework::counter();
        $vmodel = 'file';  // TODO: test
        return HTMLNode::factory(
            'b-field',
            [
                'class' => 'formularium-upload file'
            ],
            [
                HTMLNode::factory(
                    'b-upload',
                    [ 'v-model' => $vmodel ],
                    [
                        HTMLNode::factory(
                            'a',
                            [
                                'id' => $id,
                                'class' => 'button is-primary',
                            ],
                            [
                                HTMLNode::factory(
                                    'b-icon',
                                    [ 'icon' => 'upload']
                                ),
                                HTMLNode::factory(
                                    'span',
                                    [],
                                    $parameters[self::LABEL] ?? 'Click to upload'
                                )
                            ]
                        ),
                    ]
                ),
                HTMLNode::factory(
                    'span',
                    [
                        'class' => 'file-name',
                        'v-if' => $vmodel
                    ],
                    "{{{$vmodel}.name}}",
                    true
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
