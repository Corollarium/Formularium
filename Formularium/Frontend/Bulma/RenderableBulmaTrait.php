<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableBulmaTrait
{
    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    abstract public function _editable($value, Field $field, HTMLNode $previous): HTMLNode;

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        /** @var HTMLNode $base */
        $base = $this->_editable($value, $field, $previous);
        $base->addAttribute('class', "control");

        // add a div.field container
        $container = HTMLNode::factory(
            'div',
            [
                'class' => "field",
                'data-attribute' => $field->getName(),
                'data-datatype' => $field->getDatatype()->getName(),
                'data-basetype' => $field->getDatatype()->getBasetype()
            ],
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
            $label[0]->addAttributes([
                'class' => 'label',
            ]);
            // prepend
            $container->prependContent($label[0]);
        }

        return $container;
    }
}
