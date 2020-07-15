<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableViewableTrait
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
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

        return HTMLNode::factory(
            $this->framework->getViewableContainerTag(),
            [],
            HTMLNode::factory(
                $tag,
                $atts,
                [
                    HTMLNode::factory(
                        'span',
                        ['class' => 'formularium-label'],
                        $field->getRenderable(\Formularium\Renderable::LABEL, '')
                    ),
                    HTMLNode::factory(
                        'span',
                        $valueAtts,
                        $value
                    )
                ]
            )
        );
    }
}
