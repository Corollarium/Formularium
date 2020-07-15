<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

trait RenderableBulmaInputTrait
{
    use RenderableBulmaTrait;

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
        $input = $previous->get('input');
        $input[0]->setAttributes([
            'class' => 'input',
        ]);
        $comment = $previous->get('.formularium-comment');
        if (!empty($comment)) {
            $comment[0]->setTag('p')->addAttributes([
                'class' => 'help',
            ]);
        }

        $size = $field->getRenderable(Renderable::SIZE, '');
        switch ($size) {
            case Renderable::SIZE_LARGE:
                $input[0]->addAttribute('class', 'is-large');
                break;
            case Renderable::SIZE_SMALL:
                $input[0]->addAttribute('class', 'is-small');
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
            $iconElement = HTMLNode::factory(
                'span',
                [ 'class' => "icon is-small is-left" ],
                [
                    HTMLNode::factory(
                        'i',
                        [ 'class' => $iconData ],
                        []
                    )
                ]
            );
            $previous->addAttribute('class', 'has-icons-left');
            $previous->appendContent($iconElement);
        }

        return $previous;
    }
}
