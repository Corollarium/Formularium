<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableBootstrapTrait
{
    use RenderableBootstrapWrapperTrait;
    
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
        return $this->wrapper($value, $field, $this->_editable($value, $field, $previous));
    }
}
