<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Formularium\Frontend\HTML\Framework;

class Spinner extends VuetifyElement
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $node = HTMLNode::factory(
            'v-progress-circular',
            [
                'indeterminate' => null
            ]
        );
        $this->color($parameters, $node);
        return $node;
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
