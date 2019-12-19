<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype\Datatype_date;
use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_date extends Renderable_string
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $input = $element->get('input')[0];
        $input->setAttribute('type', 'date');

        /**
         * @var Datatype_date $datatype
         */
        $datatype = $field->getDatatype();
        $validators = $field->getValidators();

        if (array_key_exists(Datatype_date::MIN, $validators)) {
            $min = $validators[Datatype_date::MIN];
            if ($min === 'now') {
                $min = Datatype_date::fromString($min);
            }
            $input->setAttribute('min', $min);
        }
        if (array_key_exists(Datatype_date::MAX, $validators)) {
            $max = $validators[Datatype_date::MAX];
            if ($max === 'now') {
                $max = Datatype_date::fromString($max);
            }
            $input->setAttribute('max', $max);
        }

        return $element;
    }
}
