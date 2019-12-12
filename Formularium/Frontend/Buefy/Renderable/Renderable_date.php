<?php declare(strict_types=1); 

namespace Formularium\Frontend\Buefy\Renderable;

use Formularium\Field;
use Formularium\Frontend\Buefy\RenderableBuefyTrait;
use Formularium\HTMLElement;

class Renderable_date extends \Formularium\Renderable
{
    use RenderableBuefyTrait;

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
        $previous->walk(
            function ($e) {
                if ($e instanceof HTMLElement) {
                    if ($e->getTag() === 'input') {
                        $e->setTag('b-datepicker');
                    }
                }
            }
        );
        return $previous;
    }
}
