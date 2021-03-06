<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype\Datatype_time;
use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_time extends Renderable_string
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $input = $element->get('input')[0];
        $input->setAttribute('type', 'time');
        return $element;
    }
}
