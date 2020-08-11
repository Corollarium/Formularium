<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue\Element;

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
        $vmodel = 'file'; // TODO: test
        return HTMLNode::factory(
            'div',
            [
                'class' => 'formularium-upload'
            ],
            HTMLNode::factory(
                'b-form-group',
                [
                    'label' => $parameters[self::LABEL] ?? '',
                    'label-for' => $id,
                    'label-cols-sm' => "2"
                    // TODO size:
                ],
                HTMLNode::factory(
                    'b-form-file',
                    [
                        'id' => $id,
                        'class' => 'formularium-label',
                        'v-model' => $vmodel,
                        ':state' => "Boolean($vmodel)",
                        'placeholder' => $parameters[self::COMMENT] ?? ''
                    ],
                    $parameters[self::LABEL] ?? ''
                )
            )
        );
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLUpload::getMetadata();
        return $metadata;
    }
}
