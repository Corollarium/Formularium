<?php

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype\Datatype_uuid;
use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_uuid extends Renderable_string
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('pattern', Datatype_uuid::UUID_REGEX);
        return $element;
    }
}
