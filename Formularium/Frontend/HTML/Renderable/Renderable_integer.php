<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype\Datatype_integer;
use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_integer extends Renderable_number
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $input = $element->get('input')[0];
        
        /** @var Datatype_integer $datatype */
        $datatype = $field->getDatatype();
        $validators = $field->getValidators();

        $input->setAttribute('min', $field->getValidatorOption(Min::class, 'value', $datatype->getMinValue()));
        $input->setAttribute('max', $field->getValidatorOption(Max::class, 'value', $datatype->getMaxValue()));
    
        return $element;
    }
}
