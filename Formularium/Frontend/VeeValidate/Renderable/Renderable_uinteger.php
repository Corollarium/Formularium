<?php declare(strict_types=1);

namespace Formularium\Frontend\VeeValidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\VeeValidate\Renderable;

class Renderable_uinteger extends Renderable
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return parent::editable($value, $field, $previous);
    }
}
