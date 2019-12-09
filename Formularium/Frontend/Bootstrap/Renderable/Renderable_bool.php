<?php

namespace Formularium\Frontend\Bootstrap\Renderable;

use Formularium\Field;
use Formularium\Frontend\Bootstrap\RenderableBootstrapTrait;
use Formularium\HTMLElement;

class Renderable_bool extends \Formularium\Renderable
{
    use RenderableBootstrapTrait;
    
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $input = $previous->get('select');
        $input[0]->setAttributes([
            'class' => 'form-control',
        ]);
        return $previous;
    }
}