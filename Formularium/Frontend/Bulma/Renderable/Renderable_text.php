<?php

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;

class Renderable_text extends Renderable_string
{
    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $previous->get('textarea')[0]->setAttributes([
            'class' => 'textarea',
        ]);
        $previous->get('label')[0]->setAttributes([
            'class' => 'label',
        ]);
        return $previous;
    }
}
