<?php

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBulmaTrait
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
        $base->addAttribute('class', "control");
        return HTMLElement::factory(
            'div',
            ['class' => "field"],
            $base
        );
    }
}
