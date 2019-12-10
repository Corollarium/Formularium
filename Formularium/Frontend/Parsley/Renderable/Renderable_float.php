<?php

namespace Formularium\Frontend\Parsley\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_float extends \Formularium\Renderable
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $input = $previous->get('input')[0];
        $input->setAttribute('data-parsley-type', "number");
        // min and max come from parent
        return $previous;
    }
}
