<?php declare(strict_types=1);

namespace Formularium\Frontend\HTMLValidation\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Validator\Max;
use Formularium\Validator\Min;

class Renderable_float extends Renderable_number
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

        $element->setAttribute('min', $field->getValidatorOption(Min::class, 'value', ''));
        $element->setAttribute('max', $field->getValidatorOption(Max::class, 'value', ''));

        return parent::editable($value, $field, $previous);
    }
}
