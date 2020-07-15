<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype\Datatype_date;
use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Validator\Max;
use Formularium\Validator\Min;

class Renderable_date extends Renderable_string
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $input = $element->get('input')[0];
        $input->setAttribute('type', 'date');

        $min = $field->getValidatorOption(Min::class);
        if ($min) {
            if ($min === 'now') {
                $min = Datatype_date::fromString($min);
            }
            $input->setAttribute('min', $min);
        }
        $max = $field->getValidatorOption(Max::class);
        if ($max) {
            if ($max === 'now') {
                $max = Datatype_date::fromString($max);
            }
            $input->setAttribute('max', $max);
        }

        return $element;
    }
}
