<?php declare(strict_types=1);

namespace Formularium\Frontend\HTMLValidation;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Validator\MaxLength;
use Formularium\Validator\MinLength;
use Formularium\Validator\Regex;

class Renderable extends \Formularium\Renderable
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $validators = $field->getValidators();

        $element = $this->getInput($previous);
        if (!$element) {
            return $previous;
        }

        $datatype = $field->getDatatype();

        foreach ($validators as $validator => $data) {
            switch ($validator) {
            case MinLength::class:
                $element->setAttribute('minlength', $field->getValidatorOption($validator, 'value', ''));
                break;
            case MaxLength::class:
                $element->setAttribute('maxlength', $field->getValidatorOption($validator, 'value', ''));
                break;
            case Regex::class:
                $element->setAttribute('pattern', $field->getValidatorOption($validator, 'value', ''));
                break;
            default:
                break;
            }
        }

        return $previous;
    }

    protected function getInput(HTMLNode $previous): ?HTMLNode
    {
        /**
         * @var HTMLNode $element
         */
        $element = null;
        $input = $previous->get('input');
        if (count($input)) {
            return $input[0];
        }
        $input = $previous->get('textarea');
        if (count($input)) {
            $element = $input[0];
        }
        return $element;
    }
}
