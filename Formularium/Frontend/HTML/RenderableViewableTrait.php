<?php

namespace Formularium\Frontend\HTML;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;
use Formularium\Renderable;

trait RenderableViewableTrait
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return HTMLElement::factory(
            'div',
            [],
            [
                HTMLElement::factory(
                    'span',
                    [],
                    $field->getExtension(Renderable::LABEL, '')
                ),
                HTMLElement::factory(
                    'span',
                    [],
                    $value
                )
            ]
        );
    }
}
