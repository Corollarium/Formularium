<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

class Renderable_constant extends Renderable
{
    const HTML = 'CONSTANT_HTML';

    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->container(HTMLElement::factory('', [], self::HTML, true), $field);
    }
    
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->container(HTMLElement::factory('', [], self::HTML, true), $field);
    }
}
