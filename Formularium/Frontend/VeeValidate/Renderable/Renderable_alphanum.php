<?php declare(strict_types=1);

namespace Formularium\Frontend\VeeValidate\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Frontend\VeeValidate\Renderable;

class Renderable_alphanum extends Renderable
{
    protected function rules($value, Field $field, HTMLNode $input): array
    {
        return ['alpha_num' => true];
    }
}
