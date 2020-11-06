<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\Vuelidate\Renderable;

class Renderable_color extends Renderable
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $this->setValidations(
            $field,
            'color',
            'helpers.regex(\'color\', /^[0-9a-fA-F]{6}$/)',
            'helpers'
        );
        return parent::editable($value, $field, $previous);
    }
}
