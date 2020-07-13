<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableViewableTrait
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $tag = $field->getRenderable(Renderable::VIEWABLE_TAG, 'span');
        $atts = [
            'class' => 'formularium-viewable'
        ];
        $valueAtts = ['class' => 'formularium-value'];

        $renderables = $field->getRenderables();
        if ($renderables[RenderableInterface::SCHEMA_ITEMPROP] ?? false) {
            $valueAtts['itemprop'] = $renderables[RenderableInterface::SCHEMA_ITEMPROP];
        }

        return HTMLElement::factory(
            $this->framework->getViewableContainerTag(),
            [],
            HTMLElement::factory(
                $tag,
                $atts,
                [
                    HTMLElement::factory(
                        'span',
                        ['class' => 'formularium-label'],
                        $field->getRenderable(\Formularium\Renderable::LABEL, '')
                    ),
                    HTMLElement::factory(
                        'span',
                        $valueAtts,
                        $value
                    )
                ]
            )
        );
    }
}
