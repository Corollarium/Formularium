<?php

namespace Formularium\Frontend\Buefy;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBuefyInputTrait
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
                        $e->setTag('b-input');
                    } elseif ($e->getTag() === 'select') {
                        $e->setTag('b-select');
                    }
                }
            }
        );
        return $previous;
    }
}
