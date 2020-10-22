<?php declare(strict_types=1); 

namespace Formularium\Frontend\HTMLValidation\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_datetime extends Renderable_string
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('type', 'datetime');
        return $element;
    }
}
