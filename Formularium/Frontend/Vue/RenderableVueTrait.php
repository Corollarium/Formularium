<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableVueTrait
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $elements = $previous->get('.formularium-value');
        foreach ($elements as &$e) {
            $e->setContent('{{' . $field->getName() . '}}');
        }

        return $previous;
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
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
