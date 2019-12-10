<?php

namespace Formularium\Frontend\Materialize;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableMaterializeTrait
{
    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    abstract public function _editable($value, Field $field, HTMLElement $previous): HTMLElement;
    
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        /** @var HTMLElement $base */
        $base = $this->_editable($value, $field, $previous);
        $base->addAttribute('class', "input-field col s12");
        return HTMLElement::factory('div', ['class' => 'row'], $base);
    }
}
