<?php

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBootstrapInputTrait
{
    use RenderableBootstrapTrait;

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
        $input = $previous->get('input');
        $input[0]->setAttributes([
            'class' => 'form-control',
        ]);
        $comment = $previous->get('.formularium-comment');
        if (!empty($comment)) {
            $comment[0]->setTag('small')->setAttributes([
                'class' => 'form-text text-muted',
            ]);
        }
        return $previous;
    }
}
