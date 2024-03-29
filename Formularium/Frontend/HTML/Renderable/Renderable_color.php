<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_color extends Renderable_string
{
    public const MAX_STRING_SIZE = 7;

    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::viewable($value, $field, $previous);
        $element->get('.formularium-value')[0]
            ->prependContent(HTMLNode::factory('span', ['style' => "width: 1em; display: inline-block; background-color: $value"], '&nbsp;', true));
        return $element;
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('type', 'color');
        return $element;
    }
}
