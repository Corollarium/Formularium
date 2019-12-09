<?php

namespace Formularium\Frontend\Vue\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;

class Renderable_string extends \Formularium\Renderable
{
    public function viewable($value, Field $f, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }
    public function editable($value, Field $f, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }
}
