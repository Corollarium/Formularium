<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Renderable;

trait RenderableBootstrapWrapperTrait
{
    /**
     *
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function wrapper($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $previous->addAttributes([
            'class' => "form-group",
            'data-attribute' => $field->getName(),
            'data-datatype' => $field->getDatatype()->getName(),
            'data-basetype' => $field->getDatatype()->getBasetype()
        ]);
        return $previous;
    }

    /**
     *
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function bootstrapify($value, Field $field, HTMLNode $previous, string $tag = 'input'): HTMLNode
    {
        // add extra classes
        $input = $previous->get($tag);
        if (empty($input)) {
            return $previous;
        }
        $input = $input[0];
        $input->addAttributes([
            'class' => 'form-control',
        ]);
        $comment = $previous->get('.formularium-comment');
        if (!empty($comment)) {
            $comment[0]->setTag('small')->addAttributes([
                'class' => 'form-text text-muted',
            ]);
        }
        $size = $field->getRenderable(Renderable::SIZE, '');
        switch ($size) {
            case Renderable::SIZE_LARGE:
                $input->addAttribute('class', 'form-control-lg');
                break;
            case Renderable::SIZE_SMALL:
                $input->addAttribute('class', 'form-control-sm');
                break;
        }

        $icon = $field->getRenderable(Renderable::ICON, '');
        if ($icon) {
            $iconData = [];
            $iconPack = $field->getRenderable(Renderable::ICON_PACK, '');
            if ($iconPack) {
                $iconData[] = $iconPack;
            }
            $iconData[] = $icon;
            $group = HTMLNode::factory(
                'div',
                [ 'class' => "input-group mb-3" ],
                [
                    HTMLNode::factory(
                        'div',
                        [ 'class' => "input-group-prepend" ],
                        HTMLNode::factory(
                            'span',
                            [ 'class' => "input-group-text" ],
                            HTMLNode::factory(
                                'i',
                                [ 'class' => $iconData ],
                                []
                            )
                        )
                    ),
                    clone $input
                ]
            );
            $input->replace($group);
        }

        return $previous;
    }
}
