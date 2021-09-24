<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

trait RenderableVuetifyInputTrait
{
    use RenderableVuetifyTrait;

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
                            $e->setTag('v-radio')
                                ->setAttribute('label', $e->getAttribute('title'));
                        } else {
                            $e->setTag('v-text-field');
                        }
                    } elseif ($e->getTag() === 'select') {
                        $this->processSelect($e);
                    } elseif ($e->getTag() === 'textarea') {
                        $e->setTag('v-textarea');
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
                        $e->append(new HTMLNode('v-icon', str_replace('v-', '', $icon)));
                    }
                    */
                }
            }
        );
        return $previous;
    }

    protected function processSelect(HTMLNode $select)
    {
        $select->setTag('v-select');

        $options = [];
        $select->walk(
            function (HTMLNode $e) use ($options) {
                if ($e->getTag() == 'option') {
                    // $e->getAttribute('value')]
                    $options[] = $e->getContent();
                }
            }
        );
        $select->clearContent();
        $select->addAttribute(':items', json_encode($options));
    }
}
