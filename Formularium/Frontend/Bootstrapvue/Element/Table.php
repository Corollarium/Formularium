<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Formularium\Frontend\HTML\Element\Table as HTMLTable;

class Table extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $node = HTMLNode::factory(
            'b-table',
            [
                ':items' => 'items' // TODO
            ]
        );
        if ($parameters[HTMLTable::STRIPED] ?? false) {
            $node->addAttribute(':striped', 'true');
        }
        if ($parameters[HTMLTable::BORDERED] ?? false) {
            $node->addAttribute(':bordered', 'true');
        }

        return $node;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLTable::getMetadata();
        return $metadata;
    }
}
