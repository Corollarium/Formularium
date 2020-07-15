<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

trait RenderableBootstrapInputTrait
{
    use RenderableBootstrapTrait;

    /**
     * Subcall of wrapper editable()
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function _editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        // add extra classes
        $input = $previous->get('input')[0];
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
