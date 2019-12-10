<?php

namespace Formularium\Frontend\Buefy\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_email extends \Formularium\Renderable
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }
}
