<?php

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;

trait RenderableBulmaTrait
{
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
