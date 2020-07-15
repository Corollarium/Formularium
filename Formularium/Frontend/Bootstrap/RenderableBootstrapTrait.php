<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableBootstrapTrait
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
        $base->addAttributes([
            'class' => "form-group",
            'data-attribute' => $field->getName(),
            'data-datatype' => $field->getDatatype()->getName(),
            'data-basetype' => $field->getDatatype()->getBasetype()
        ]);
        return $base;
    }
}
