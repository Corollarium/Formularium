<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

trait RenderableBootstrapvueInputTrait
{
    use RenderableBootstrapvueTrait;

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
                        // TODO: form-group
                        if (($e->getAttribute('type')[0] ?? '') === 'radio') {
                            $e->setTag('b-form-radio')
                                ->setAttribute('native-value', $e->getAttribute('value'))
                                ->setContent($e->getAttribute('title'));
                        } else {
                            $e->setTag('b-form-input');
                        }
                    } elseif ($e->getTag() === 'select') {
                        $e->setTag('b-form-select');
                    } elseif ($e->getTag() === 'textarea') {
                        $e->setTag('b-form-textarea');
                    } else {
                        return;
                    }

                    $size = $field->getRenderable(Renderable::SIZE, '');
                    switch ($size) {
                        case Renderable::SIZE_LARGE:
                            $e->addAttribute('size', 'large');
                            break;
                        case Renderable::SIZE_SMALL:
                            $e->addAttribute('size', 'small');
                            break;
                    }

                    /* TODO
                    $icon = $field->getRenderable(Renderable::ICON, '');
                    if ($icon) {
                        $e->addAttribute('icon', str_replace('fa-', '', $icon));
                    }
                    $iconPack = $field->getRenderable(Renderable::ICON_PACK, '');
                    if ($iconPack) {
                        $e->addAttribute('icon-pack', $iconPack);
                    }
                    */
                }
            }
        );
        return $previous;
    }
}
