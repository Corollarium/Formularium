<?php

namespace Formularium\Frontend\Bulma;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;

trait RenderableBulmaInputTrait
{
    use RenderableBulmaTrait;

    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $input = $previous->get('input');
        $input[0]->setAttributes([
            'class' => 'input',
        ]);
        $label = $previous->get('label');
        if ($label) {
            $label[0]->setAttributes([
                'class' => 'label',
            ]);
        }
        return $previous;
    }
}
