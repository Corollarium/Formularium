<?php declare(strict_types=1);

namespace Formularium\Frontend\HTMLValidation\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTMLValidation\Renderable;
use Formularium\HTMLNode;

class Renderable_file extends Renderable
{
    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }
}
