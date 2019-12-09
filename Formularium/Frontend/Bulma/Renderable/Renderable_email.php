<?php

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;

class Renderable_email extends Renderable_string
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('type', 'email');
        // Validation? $element->appendContent(new HTMLElement('p', ['class' => "help is-danger"], 'This email is invalid'));
        return $element;
    }
}
