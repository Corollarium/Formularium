<?php

namespace Formularium\Datatype;

use Formularium\Exception\Exception;
use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Respect\Validation\Validator;

class Datatype_email extends Datatype_string
{
    public function __construct($typename = 'email', $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return static::faker()->email;
    }

    public function validate($value, Field $f)
    {
        if ($value === '' || Validator::email()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid email: ' . $value);
    }
}
