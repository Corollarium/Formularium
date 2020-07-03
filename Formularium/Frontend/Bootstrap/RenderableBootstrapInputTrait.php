<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

trait RenderableBootstrapInputTrait
{
    use RenderableBootstrapTrait;

    /**
     * Subcall of wrapper editable()
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
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
            $group = HTMLElement::factory(
                'div',
                [ 'class' => "input-group mb-3" ],
                [
                    HTMLElement::factory(
                        'div',
                        [ 'class' => "input-group-prepend" ],
                        HTMLElement::factory(
                            'span',
                            [ 'class' => "input-group-text" ],
                            HTMLElement::factory(
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
