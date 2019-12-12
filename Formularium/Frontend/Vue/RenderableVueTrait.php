<?php declare(strict_types=1); 

namespace Formularium\Frontend\Vue;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableVueTrait
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        foreach ($previous->get('input') as $input) {
            $input->setAttribute('v-model', $field->getName())
                ->removeAttribute('value');
        }
        foreach ($previous->get('textarea') as $textarea) {
            $textarea->setAttribute('v-model', $field->getName());
        }
        foreach ($previous->get('select') as $input) {
            $input->setAttribute('v-model', $field->getName())
                ->removeAttribute('value');
        }
        return $previous;
    }
}
