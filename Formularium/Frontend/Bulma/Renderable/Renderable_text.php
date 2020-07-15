<?php declare(strict_types=1); 

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_text extends Renderable_string
{
    public function _editable($value, Field $field, HTMLNode $previous): HTMLNode
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
