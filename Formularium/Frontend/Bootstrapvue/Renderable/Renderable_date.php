<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue\Renderable;

use Formularium\Field;
use Formularium\Frontend\Bootstrapvue\RenderableBootstrapvueTrait;
use Formularium\HTMLNode;

class Renderable_date extends \Formularium\Renderable
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
            function ($e) {
                if ($e instanceof HTMLNode) {
                    if ($e->getTag() === 'input') {
                        $e->setTag('b-form-datepicker');
                    }
                }
            }
        );
        return $previous;
    }
}
