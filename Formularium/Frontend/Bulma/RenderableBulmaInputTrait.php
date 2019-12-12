<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

trait RenderableBulmaInputTrait
{
    use RenderableBulmaTrait;

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

        $size = $field->getExtension(Renderable::SIZE, '');
        switch ($size) {
            case Renderable::SIZE_LARGE:
                $input[0]->addAttribute('class', 'is-large');
                break;
            case Renderable::SIZE_SMALL:
                $input[0]->addAttribute('class', 'is-small');
                break;
        }
        $icon = $field->getExtension(Renderable::ICON, '');
        if ($icon) {
            $iconData = [];
            $iconPack = $field->getExtension(Renderable::ICON_PACK, '');
            if ($iconPack) {
                $iconData[] = $iconPack;
            }
            $iconData[] = $icon;
            $iconElement = HTMLElement::factory(
                'span',
                [ 'class' => "icon is-small is-left" ],
                [
                    HTMLElement::factory(
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
