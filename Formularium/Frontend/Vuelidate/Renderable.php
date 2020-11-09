<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate;

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


        foreach ($validators as $validator => $data) {
            switch ($validator) {
            case Datatype::REQUIRED:
            case Filled::class:
                $this->setValidations(
                    $field,
                    'required',
                    'required'
                );
                break;
            case Equals::class:
                // TODO
                break;

            case In::class:
                // TODO
                break;

            case Max::class:
                $this->setValidations(
                    $field,
                    'maxValue',
                    'maxValue(' . $field->getValidatorOption($validator, 'value', '') . ')'
                );
                break;
            case Min::class:
                $this->setValidations(
                    $field,
                    'minValue',
                    'minValue(' . $field->getValidatorOption($validator, 'value', '') . ')'
                );
                break;

            case MaxLength::class:
                $this->setValidations(
                    $field,
                    'maxLength',
                    'maxLength(' . $field->getValidatorOption($validator, 'value', '') . ')'
                );
                break;
            case MinLength::class:
                $this->setValidations(
                    $field,
                    'minLength',
                    'minLength(' . $field->getValidatorOption($validator, 'value', '') . ')'
                );
                break;

            case NotIn::class:
                // TODO
                break;

            case Password::class:
                // TODO
                break;

            case Regex::class:
                $name = 'regex' . mt_rand();
                $this->setValidations(
                    $field,
                    $name,
                    'helpers.regex(\'' . $name . '\', /' . $field->getValidatorOption($validator, 'value', '') . '/)',
                    'helpers'
                );
                break;

            case SameAs::class:
                $target = $field->getValidatorOption($validator, 'value', '');
                $locator = $target;// TODO
                $this->setValidations(
                    $field,
                    'sameAs',
                    'sameAs(' . $locator . ')'
                );
                break;
            default:
                break;
            }
        }

        return $previous;
    }

    protected function getVueCode(): VueCode
    {
        /**
         * @var FrameworkVue $vue
         */
        $vue = $this->composer->getByName('Vue');
        return $vue->getVueCode();
    }

    /**
     * Sets validation
     *
     * @param Field $field
     * @param string $name
     * @param string $value
     * @param string $import
     * @return void
     */
    protected function setValidations(Field $field, $name, $value, $import = ''): void
    {
        $vueCode = $this->getVueCode();
        $vueCode->appendImport($import ? $import : $name, 'vuelidate/lib/validators');
        $other = &$vueCode->getOther();
        $other['validations']['form'][$field->getName()][$name] = $value;
    }
}
