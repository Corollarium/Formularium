<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\Vuelidate\Renderable;

class Renderable_alphanumdash extends Renderable
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $this->setValidations(
            $field,
            'alphaNumDash',
            'helpers.regex(\'alphaNumDash\', /^[0-9a-zA-Z\-]*$/)',
            'helpers'
        );
        return parent::editable($value, $field, $previous);
    }
}
