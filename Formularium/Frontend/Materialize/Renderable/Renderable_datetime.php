<?php

namespace Formularium\Frontend\Materialize\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_datetime extends Renderable_string
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $input = $element->get('input')[0];
        $input->setTag('p');
        $input->setContent('Materialize does not have a datetime picker.');
        return $element;
    }
}
