<?php declare(strict_types=1); 

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_color extends Renderable_string
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::viewable($value, $field, $previous);
        $element->get('.formularium-value')[0]
            ->prependContent(HTMLElement::factory('span', ['style' => "width: 1em; display: inline-block; background-color: $value"], '&nbsp;', true));
        return $element;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('type', 'color');
        return $element;
    }
}
