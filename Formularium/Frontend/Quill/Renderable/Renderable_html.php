<?php declare(strict_types=1);

namespace Formularium\Frontend\Quill\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;
use Formularium\Renderable;

class Renderable_html extends Renderable
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }
   
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $textarea = $previous->get('textarea')[0];
        $textarea->setTag('div');
        $id = $textarea->getAttribute('id')[0];
        $previous->appendContent(
            HTMLElement::factory(
                'script',
                [],
                "var quill = new Quill('#{$id}', { theme: 'snow' });",
                true
            )
        );
        return $previous;
    }
}
