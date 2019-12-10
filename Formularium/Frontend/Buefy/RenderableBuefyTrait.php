<?php

namespace Formularium\Frontend\Buefy;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBuefyTrait
{
    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    abstract public function _editable($value, Field $field, HTMLElement $previous): HTMLElement;

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        /** @var HTMLElement $base */
        $base = $this->_editable($value, $field, $previous);

        $extensions = $field->getExtensions();
        $base->setTag('b-field');

        if (array_key_exists('label', $extensions)) {
            $base->setAttribute('label', $extensions['label']);
        }
        if (array_key_exists('comment', $extensions)) {
            $base->setAttribute('message', $extensions['comment']);
        }
        $base->filter(function ($e) {
            if ($e instanceof HTMLElement) {
                if ($e->getTag() === 'label') {
                    return false;
                }
                if ($e->getTag() === 'div' && $e->getAttribute('class') === ['comment']) {
                    return false;
                }
            }
            return true;
        });

        return $base;
    }
}
