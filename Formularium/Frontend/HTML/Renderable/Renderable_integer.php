<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype\Datatype_integer;
use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Validator\Max;
use Formularium\Validator\Min;

class Renderable_integer extends Renderable_number
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $input = $element->get('input')[0];
        
        /** @var Datatype_integer $datatype */
        $datatype = $field->getDatatype();
    
        return $element;
    }
}
