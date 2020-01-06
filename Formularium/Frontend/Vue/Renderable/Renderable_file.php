<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue\Renderable;

use Formularium\Field;
use Formularium\Frontend\Vue\RenderableVueTrait;
use Formularium\HTMLElement;

class Renderable_file extends \Formularium\Renderable
{
    use RenderableVueTrait {
        RenderableVueTrait::editable as _editable;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $previous = $this->_editable($value, $field, $previous);
        foreach ($previous->get('[type=file]') as $input) {
            $input->setAttribute('v-on:change', 'changedFile(' . $field->getName() . ', $event)')
                ->removeAttribute('v-model');
        }
        return $previous;
    }
}
