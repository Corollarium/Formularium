<?php declare(strict_types=1);

namespace Formularium\Frontend\HTMLValidation;

use Formularium\Extradata;
use Formularium\Field;
use Formularium\Frontend\Vue\Framework as FrameworkVue;
use Formularium\Frontend\Vue\VueCode;
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

        $vueCode = $this->getVueCode();
        foreach ($validators as $validator => $data) {
            switch ($validator) {
            case MinLength::class:
                $this->setValidations(
                    $vueCode,
                    $field,
                    'minLength',
                    'minLength(' . $field->getValidatorOption($validator, 'value', '') . ')'
                );
                break;
            case MaxLength::class:
                $this->setValidations(
                    $vueCode,
                    $field,
                    'maxLength',
                    'maxLength(' . $field->getValidatorOption($validator, 'value', '') . ')'
                );
                break;
            case Regex::class:
                // TODO
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
     * Undocumented function
     *
     * @param VueCode $vueCode
     * @param Field $field
     * @param string $name
     * @param string $value
     * @return void
     */
    protected function setValidations(VueCode $vueCode, Field $field, $name, $value): void
    {
        $other = &$vueCode->getOther();
        $other['validations']['form'][$field->getName()][$name] = $value;
    }
}
