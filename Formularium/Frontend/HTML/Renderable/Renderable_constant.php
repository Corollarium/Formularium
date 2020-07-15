<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

class Renderable_constant extends Renderable
{
    const HTML = 'CONSTANT_HTML';

    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $this->container(HTMLNode::factory('', [], $field->getRenderable(self::HTML, ''), true), $field);
    }
    
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $this->container(HTMLNode::factory('', [], $field->getRenderable(self::HTML, ''), true), $field);
    }
}
