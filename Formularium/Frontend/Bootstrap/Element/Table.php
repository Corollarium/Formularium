<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\Frontend\HTML\Element\Table as HTMLTable;

class Table extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->addAttribute('class', 'table');

        if ($parameters[HTMLTable::STRIPED] ?? false) {
            $previous->addAttribute('class', 'table-striped');
        }
        if ($parameters[HTMLTable::BORDERED] ?? false) {
            $previous->addAttribute('class', 'table-bordered');
        }

        return $previous;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLTable::getMetadata();
        return $metadata;
    }
}
