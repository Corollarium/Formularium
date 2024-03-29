<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype\Datatype_uuid;
use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_uuid extends Renderable_string
{
    public const MAX_STRING_SIZE = 32;

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('pattern', Datatype_uuid::UUID_REGEX);
        return $element;
    }
}
