<?php declare(strict_types=1);

namespace Formularium\Frontend\Blade;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBladeTrait
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        foreach ($previous->get('formularium-value') as $input) {
            $input->setContent("{{Request::input('" . $field->getName() . "')}}");
        }
        return $previous;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        foreach ($previous->get('input') as $input) {
            $input->setAttribute('value', "{{Request::input('" . $field->getName() . "')}}");
        }
        foreach ($previous->get('textarea') as $textarea) {
            $input->setContent("{{Request::input('" . $field->getName() . "')}}");
        }
        foreach ($previous->get('select') as $input) {
            $input->setAttribute('value', "{{Request::input('" . $field->getName() . "')}}");
        }
        return $previous;
    }
}
