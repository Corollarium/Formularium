<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_html extends Renderable_text
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = parent::editable($value, $field, $previous);
        $textarea = $element->get('textarea')[0];
        $textarea->addAttribute('class', 'formularium-html-editor');
        return $element;
    }
}
