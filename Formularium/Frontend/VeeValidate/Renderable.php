<?php declare(strict_types=1);

namespace Formularium\Frontend\VeeValidate;

use Formularium\Datatype;
use Formularium\Extradata;
use Formularium\Field;
use Formularium\Frontend\Vue\Framework as FrameworkVue;
use Formularium\Frontend\Vue\VueCode;
use Formularium\HTMLNode;
use Formularium\Validator\Equals;
use Formularium\Validator\Filled;
use Formularium\Validator\In;
use Formularium\Validator\Max;
use Formularium\Validator\MaxLength;
use Formularium\Validator\Min;
use Formularium\Validator\MinLength;
use Formularium\Validator\NotIn;
use Formularium\Validator\Password;
use Formularium\Validator\Regex;
use Formularium\Validator\SameAs;

class Renderable extends \Formularium\Renderable
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $validators = $field->getValidators();
        
        // get the tag
        /**
         * @var HTMLNode|null $validationNode
         */
        $validationNode = null;
        $input = $previous->get('input');
        if (count($input)) {
            $validationNode = $input[0];
        }
        if (!$validationNode) {
            $input = $previous->get('textarea');
            if (count($input)) {
                $validationNode = $input[0];
            }
        }
        if (!$validationNode) {
            $input = $previous->get('select');
            if (count($input)) {
                $validationNode = $input[0];
            }
        }
        if (!$validationNode) {
            return $previous;
        }

        // add rules
        $newInput = clone $validationNode;
        $validationNode->setTag('validation-provider');
        $validationNode->clearAttributes()->clearContent();
        $validationNode->addAttribute('v-slot', '{ errors }')
            ->addContent([
                $newInput,
                new HTMLNode('span', [], '{{ v.errors[0] }}')
            ]);

        $rules = [];
        foreach ($validators as $validator => $data) {
            switch ($validator) {
            case Datatype::REQUIRED:
            case Filled::class:
                $rules['required'] = true;
                break;

            case Equals::class:
                $rules['oneOf'] = implode(',', $field->getValidatorOption($validator, 'value', ''));
                break;

            case In::class:
                $rules['oneOf'] = implode(',', $field->getValidatorOption($validator, 'value', ''));
                break;

            case Max::class:
                $rules['max_value'] = $field->getValidatorOption($validator, 'value', '');
                break;
            case Min::class:
                $rules['min_value'] = $field->getValidatorOption($validator, 'value', '');
                break;

            case MaxLength::class:
                $rules['max'] = $field->getValidatorOption($validator, 'value', '');
                break;
            case MinLength::class:
                $rules['min'] = $field->getValidatorOption($validator, 'value', '');
                break;

            case NotIn::class:
                // TODO
                break;

            case Password::class:
                // TODO
                break;

            case Regex::class:
                $rules['regex'] = $field->getValidatorOption($validator, 'value', '');
                break;

            case SameAs::class:
                // TODO
                break;
            default:
                break;
            }
        }
        $validationNode->addAttribute(
            'rules',
            json_encode(array_merge($rules, $this->rules($value, $field, $newInput)))
        );

        return $previous;
    }

    /**
     * Other rules to add
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $input
     * @return array
     */
    protected function rules($value, Field $field, HTMLNode $input): array
    {
        return [];
    }
}
