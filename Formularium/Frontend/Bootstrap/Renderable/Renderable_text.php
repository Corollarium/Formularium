<?php declare(strict_types=1); 

namespace Formularium\Frontend\Bootstrap\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_text extends Renderable_string
{
    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function _editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        // add extra classes
        $previous->get('textarea')[0]->setAttributes([
            'class' => 'form-control',
        ]);
        return $previous;
    }
}
