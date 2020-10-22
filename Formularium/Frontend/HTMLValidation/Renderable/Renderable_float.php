<?php declare(strict_types=1);

namespace Formularium\Frontend\HTMLValidation\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_float extends Renderable_number
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $validators = $field->getValidators();
        /**
         * @var HTMLNode $element
         */
        $element = $this->getInput($previous);
        if (!$element) {
            return $previous;
        }

        /** @var Datatype_integer $datatype */
        $datatype = $field->getDatatype();
        $element->setAttribute('min', $field->getValidatorOption(Min::class, 'value', ''));
        $element->setAttribute('max', $field->getValidatorOption(Max::class, 'value', ''));

        return parent::editable($value, $field, $previous);
    }
}
