<?php declare(strict_types=1); 

namespace Formularium\Frontend\Parsley\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_usmall extends \Formularium\Renderable
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
