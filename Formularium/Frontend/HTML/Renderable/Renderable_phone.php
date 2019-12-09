<?php

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_phone extends Renderable_string
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('type', 'tel');
        return $element;
    }
}
