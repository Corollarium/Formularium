<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableVueTrait
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $mvar = $this->framework->getFieldModelVariable();
        $elements = $previous->get('.formularium-value');
        foreach ($elements as &$e) {
            $e->setContent('{{' . $mvar . $field->getName() . '}}');
        }

        return $previous;
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $mvar = $this->framework->getFieldModelVariable();
        foreach ($previous->get('input') as $input) {
            $input->setAttribute('v-model', $mvar . $field->getName())
                ->removeAttribute('value');
        }
        foreach ($previous->get('textarea') as $textarea) {
            $textarea->setAttribute('v-model', $mvar . $field->getName());
        }
        foreach ($previous->get('select') as $input) {
            $input->setAttribute('v-model', $mvar . $field->getName())
                ->removeAttribute('value');
        }
        return $previous;
    }
}
