<?php

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;

class Renderable_color extends Renderable_string
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('type', 'color');
        return $element;
    }
}
