<?php

namespace Formularium\Frontend\Bootstrap\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_text extends Renderable_string
{
    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $previous->get('textarea')[0]->setAttributes([
            'class' => 'form-control',
        ]);
        return $previous;
    }
}
