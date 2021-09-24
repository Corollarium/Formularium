<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Formularium\Frontend\HTML\Element\Table as HTMLTable;

class Table extends VuetifyElement
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $node = HTMLNode::factory(
            'v-simple-table',
            [
                // TODO
            ]
        );

        return $node;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLTable::getMetadata();
        return $metadata;
    }
}
