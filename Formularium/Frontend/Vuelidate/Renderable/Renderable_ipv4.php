<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\Vuelidate\Renderable;

class Renderable_ipv4 extends Renderable
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $this->setValidations(
            $field,
            'ipAddress',
            'ipAddress'
        );

        return parent::editable($value, $field, $previous);
    }
}
