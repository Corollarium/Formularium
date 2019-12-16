<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_html extends Renderable_text
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $textarea = $element->get('textarea')[0];
        $textarea->addAttribute('class', 'formularium-html-editor');
        return $element;
    }
}
