<?php declare(strict_types=1);

namespace Formularium\Frontend\Quill\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Renderable;

class Renderable_html extends Renderable
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }
   
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $textarea = $previous->get('textarea')[0];
        $textarea->setTag('div');
        $id = $textarea->getAttribute('id')[0];
        $previous->appendContent(
            HTMLNode::factory(
                'script',
                [],
                "var quill = new Quill('#{$id}', { theme: 'snow' });",
                true
            )
        );
        return $previous;
    }
}
