<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\Vuelidate\Renderable;

class Renderable_url extends Renderable
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return parent::editable($value, $field, $previous);
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $this->setValidations(
            $field,
            'url',
            'url'
        );

        return parent::editable($value, $field, $previous);
    }
}
