<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_text extends Renderable_string
{
    public const MAX_STRING_SIZE = 1024000;
    
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setTag('textarea');
        return $element;
    }
}
