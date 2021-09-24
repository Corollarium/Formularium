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

        foreach ($validators as $validator => $data) {
            switch ($validator) {
            case MinLength::class:
                $element->setAttribute('minlength', $field->getValidatorOption($validator, 'value', ''));
                break;
            case MaxLength::class:
                $element->setAttribute('maxlength', $field->getValidatorOption($validator, 'value', ''));
                $element->setAttribute('mgmvlength', 'xxxxxxxxxxx');
                break;
            case Regex::class:
                $pattern = $field->getValidatorOption($validator, 'value', '');
                if ($pattern[0] === '/' && $pattern[-1] === '/') {
                    $pattern = mb_substr($pattern, 1, mb_strlen($pattern) - 2);
                }
                $element->setAttribute('pattern', $pattern);
                break;
            default:
                break;
            }
        }

        return $previous;
    }

    /**
     * @param HTMLNode $previous
     * @return HTMLNode|null
     */
    protected function getInput(HTMLNode $previous): ?HTMLNode
    {
        $input = $previous->get('input');
        if (count($input)) {
            return $input[0];
        }
        $input = $previous->get('textarea');
        if (count($input)) {
            return $input[0];
        }
        return null;
    }
}
