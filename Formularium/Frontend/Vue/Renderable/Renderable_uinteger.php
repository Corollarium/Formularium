<?php

namespace Formularium\Frontend\Vue\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_uinteger extends \Formularium\Renderable
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
