<?php declare(strict_types=1);

namespace Formularium\Frontend\HTMLValidation\Renderable;

use Formularium\Datatype\Datatype_integer;
use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Validator\Max;
use Formularium\Validator\Min;

class Renderable_integer extends Renderable_number
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $validators = $field->getValidators();
        /**
         * @var HTMLNode|null $element
         */
        $element = $this->getInput($previous);
        if (!$element) {
            return $previous;
        }

        /** @var Datatype_integer $datatype */
        $datatype = $field->getDatatype();
        $element->setAttribute('min', $field->getValidatorOption(Min::class, 'value', $datatype->getMinValue()));
        $element->setAttribute('max', $field->getValidatorOption(Max::class, 'value', $datatype->getMaxValue()));

        return parent::editable($value, $field, $previous);
    }
}
