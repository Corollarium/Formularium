<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\Vuelidate\Renderable;

class Renderable_usmall extends Renderable
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $this->setValidations(
            $field,
            'integer',
            'integer'
        );

        return parent::editable($value, $field, $previous);
    }
}
