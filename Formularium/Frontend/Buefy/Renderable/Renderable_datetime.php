<?php declare(strict_types=1); 

namespace Formularium\Frontend\Buefy\Renderable;

use Formularium\Field;
use Formularium\Frontend\Buefy\RenderableBuefyTrait;
use Formularium\HTMLNode;

class Renderable_datetime extends \Formularium\Renderable
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
            function ($e) {
                if ($e instanceof HTMLNode) {
                    if ($e->getTag() === 'input') {
                        $e->setTag('b-datetimepicker');
                    }
                }
            }
        );
        return $previous;
    }
}
