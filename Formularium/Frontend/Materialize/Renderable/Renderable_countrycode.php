<?php

namespace Formularium\Frontend\Materialize\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_countrycode extends \Formularium\Renderable
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
