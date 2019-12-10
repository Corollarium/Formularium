<?php

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBootstrapTrait
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
        $base->addAttribute('class', "form-group");
        return $base;
    }
}
