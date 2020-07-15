<?php declare(strict_types=1);

namespace Formularium\Frontend\Blade;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableBladeTrait
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        foreach ($previous->get('formularium-value') as $input) {
            $input->setContent("{{Request::input('" . $field->getName() . "')}}");
        }
        return $previous;
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        foreach ($previous->get('input') as $input) {
            $input->setAttribute('value', "{{Request::input('" . $field->getName() . "')}}");
        }
        foreach ($previous->get('textarea') as $textarea) {
            $textarea->setContent("{{Request::input('" . $field->getName() . "')}}");
        }
        foreach ($previous->get('select') as $input) {
            $input->setAttribute('value', "{{Request::input('" . $field->getName() . "')}}");
        }
        return $previous;
    }
}
