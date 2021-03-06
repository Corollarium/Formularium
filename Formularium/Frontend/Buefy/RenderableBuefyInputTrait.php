<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

trait RenderableBuefyInputTrait
{
    use RenderableBuefyTrait;

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
        $previous->walk(
            function ($e) use ($field) {
                if ($e instanceof HTMLNode) {
                    if ($e->getTag() === 'input') {
                        if (($e->getAttribute('type')[0] ?? '') === 'radio') {
                            $e->setTag('b-radio')
                                ->setAttribute('native-value', $e->getAttribute('value'))
                                ->setContent($e->getAttribute('title'));
                        } else {
                            $e->setTag('b-input');
                        }
                    } elseif ($e->getTag() === 'select') {
                        $e->setTag('b-select');
                    } elseif ($e->getTag() === 'textarea') {
                        $e->setTag('b-input')->setAttribute('type', 'textarea');
                    } else {
                        return;
                    }

                    $size = $field->getRenderable(Renderable::SIZE, '');
                    switch ($size) {
                        case Renderable::SIZE_LARGE:
                            $e->addAttribute('size', 'is-large');
                            break;
                        case Renderable::SIZE_SMALL:
                            $e->addAttribute('size', 'is-small');
                            break;
                    }

                    $icon = $field->getRenderable(Renderable::ICON, '');
                    if ($icon) {
                        $e->addAttribute('icon', str_replace('fa-', '', $icon));
                    }
                    $iconPack = $field->getRenderable(Renderable::ICON_PACK, '');
                    if ($iconPack) {
                        $e->addAttribute('icon-pack', $iconPack);
                    }
                }
            }
        );
        return $previous;
    }
}
