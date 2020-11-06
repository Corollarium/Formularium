<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\Vuelidate\Renderable;

class Renderable_cnpj extends Renderable
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        // TODO
        return parent::editable($value, $field, $previous);
    }
}
