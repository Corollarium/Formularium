<?php declare(strict_types=1); 

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_text extends Renderable_string
{
    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $previous->get('textarea')[0]->setAttributes([
            'class' => 'textarea',
        ]);
        $label = $previous->get('label');
        if (!empty($label)) {
            $label [0]->setAttributes([
                'class' => 'label',
            ]);
        }
        return $previous;
    }
}
