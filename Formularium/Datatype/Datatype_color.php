<?php

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;

class Datatype_color extends Datatype_string
{
    public function __construct(string $typename = 'color', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function validate($value, Field $f)
    {
        $match = preg_match('/^#[0-9A-Fa-f]{6}$/', $value);
        if ($value !== "" && $match !== 1) {
            throw new ValidatorException('Only hexadecimal colors are allowed');
        }
        return $value;
    }
}
