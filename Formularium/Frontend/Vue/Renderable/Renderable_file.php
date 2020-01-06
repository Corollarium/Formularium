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

    /**
     * Subcall of wrapper editable()
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
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
