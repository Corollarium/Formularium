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
                    }
                }
            }
        );
        return $previous;
    }
}
