<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Upload as HTMLUpload;
use Formularium\Frontend\HTML\Framework as HTMLFramework;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Upload extends VuetifyElement
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
                'v-file-input',
                [
                    'id' => $id,
                    'v-model' => $vmodel,
                ],
                $parameters[self::LABEL] ?? ''
            )
        );
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLUpload::getMetadata();
        return $metadata;
    }
}
