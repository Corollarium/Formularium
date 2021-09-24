<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Renderable;

use Formularium\Field;
use Formularium\Frontend\Vue\RenderableVueTrait;
use Formularium\HTMLNode;
use Formularium\Frontend\Vuetify\RenderableVuetifyInputTrait;

class Renderable_color extends \Formularium\Renderable
{
    use RenderableVueTrait;

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
            function ($e) {
                if ($e instanceof HTMLNode) {
                    if ($e->getTag() === 'input') {
                        $e->setTag('v-color-picker');
                    }
                }
            }
        );
        return $previous;
    }
}
