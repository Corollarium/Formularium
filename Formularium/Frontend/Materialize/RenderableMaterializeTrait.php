<?php declare(strict_types=1); 

namespace Formularium\Frontend\Materialize;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableMaterializeTrait
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
        $base->addAttribute('class', "input-field col s12");
        return HTMLNode::factory('div', ['class' => 'row'], $base);
    }
}
