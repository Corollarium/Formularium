<?php

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableBulmaInputTrait
{
    use RenderableBulmaTrait;

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
            'class' => 'input',
        ]);
        $label = $previous->get('label');
        if (!empty($label)) {
            $label[0]->setAttributes([
                'class' => 'label',
            ]);
        }
        $comment = $previous->get('div.comment');
        if (!empty($comment)) {
            $comment[0]->setTag('p')->setAttributes([
                'class' => 'help',
            ]);
        }
        return $previous;
    }
}
