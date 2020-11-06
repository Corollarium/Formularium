<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\Vuelidate\Renderable;

class Renderable_uuid extends Renderable
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $this->setValidations(
            $field,
            'color',
            'helpers.regex(\'uuid\', /^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/)'
        );
        return parent::editable($value, $field, $previous);
    }
}
