<?php

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBulmaTrait
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
        $base->addAttribute('class', "control");

        // add a div.field container
        $container = HTMLElement::factory(
            'div',
            ['class' => "field"],
            $base
        );

        // move the main label to the div.field container
        $label = $base->get('label.formularium-label');
        if (!empty($label)) {
            // delete
            $base->filter(function ($e) {
                return !($e->getTag() === 'label' && $e->getAttribute('class') === ['formularium-label']);
            });
            // fix class
            $label[0]->setAttributes([
                'class' => 'label',
            ]);
            // prepend
            $container->prependContent($label[0]);
        }

        return $container;
    }
}
