<?php declare(strict_types=1); 

namespace Formularium\Frontend\HTML;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableViewableTrait
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return HTMLElement::factory(
            Framework::getViewableContainerTag(),
            [],
            [
                HTMLElement::factory(
                    'span',
                    ['class' => 'formularium-label'],
                    $field->getExtension(\Formularium\Renderable::LABEL, '')
                ),
                HTMLElement::factory(
                    'span',
                    ['class' => 'formularium-value'],
                    $value
                )
            ]
        );
    }
}
