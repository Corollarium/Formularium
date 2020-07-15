<?php declare(strict_types=1); 

namespace Formularium\Frontend\Parsley\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_integer extends \Formularium\Renderable
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $input = $previous->get('input')[0];
        $input->setAttribute('data-parsley-type', "integer");
        $input->setAttribute('data-parsley-type', 'digits');
        return $previous;
    }
}
