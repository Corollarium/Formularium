<?php

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBootstrapTrait
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        /** @var HTMLElement $base */
        $base = $this->_editable($value, $field, $previous);
        $base->addAttribute('class', "form-group");
        return $base;
    }
}
