<?php

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;

class Datatype_bool extends \Formularium\Datatype
{
    public function __construct(string $typename = 'bool', string $basetype = 'bool')
    {
        parent::__construct($typename, $basetype);
    }

    public function getDefault()
    {
        return false;
    }

    public function getRandom(array $params = [])
    {
        return (bool)rand(0, 1);
    }

    public function format($value, Field $f)
    {
        return $value == true ? 'True' : 'False';
    }

    public function validate($value, Field $f)
    {
        if (is_string($value)) {
            if (strcasecmp($value, 'true') == 0 || $value == '1') {
                return true;
            } elseif (strcasecmp($value, 'false') == 0 || $value == '0') {
                return false;
            } else {
                throw new ValidatorException('Invalid boolean value');
            }
        }
        return $value == true;
    }
}
