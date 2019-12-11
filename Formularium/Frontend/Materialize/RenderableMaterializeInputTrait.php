<?php

namespace Formularium\Frontend\Materialize;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableMaterializeInputTrait
{
    use RenderableMaterializeTrait;

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
        $newContent = [];
        $input = $previous->get('input');
        $input[0]->setAttributes([
            'class' => 'validate',
        ]);
        $newContent[] = $input[0];
        $label = $previous->get('label');
        if (!empty($label)) {
            $newContent[] = $label[0];
        }
        $comment = $previous->get('.formularium-comment');
        if (!empty($comment)) {
            $comment[0]->setTag('span')->setAttributes([
                'class' => 'helper-text',
                'data-error' => "wrong",
                'data-success' => "right"
            ]);
            $newContent[] = $comment[0];
        }
        $previous->setContent($newContent);
        return $previous;
    }
}
