<?php declare(strict_types=1); 

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_email extends Renderable_string
{
    const SCRAMBLE = 'scramble';

    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        if ($field->getRenderable(static::SCRAMBLE, false)) {
            $value = str_ireplace(
                '@',
                '<span style="display:none;">null</span>@<span style="display:none;">none</span>',
                $value
            );
        }
        return parent::viewable($value, $field, $previous);
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $element->get('input')[0]->setAttribute('type', 'email');
        return $element;
    }
}
