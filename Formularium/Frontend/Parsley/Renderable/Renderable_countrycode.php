<?php declare(strict_types=1); 

namespace Formularium\Frontend\Parsley\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_countrycode extends \Formularium\Renderable
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }
}
