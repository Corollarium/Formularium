<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

class Renderable_constant extends Renderable
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }
    
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }
}
