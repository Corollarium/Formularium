<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\HTMLNode;

trait RenderableBootstrapInputTrait
{
    use RenderableBootstrapTrait;

    /**
     * Subcall of wrapper editable()
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

    /**
     *
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function _editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $this->bootstrapify($value, $field, $previous);
    }
}
