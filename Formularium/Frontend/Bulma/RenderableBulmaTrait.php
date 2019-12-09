<?php

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;

trait RenderableBulmaTrait
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $base = $this->_editable($value, $field, $previous);
        $base->addAttribute('class', "control");
        $element = HTMLElement::factory(
            'div',
            ['class' => "field"],
            $base
        );
        return $element;
    }
}
