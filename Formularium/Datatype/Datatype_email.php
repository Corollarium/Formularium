<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Respect\Validation\Validator;

class Datatype_email extends Datatype_string
{
    // RFC 5321 states: The maximum total length of a reverse-path or forward-path is 256 characters.
    protected $MAX_STRING_SIZE = 256;

    public function __construct(string $typename = 'email', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return static::faker()->email;
    }

    public function validate($value, Model $model = null)
    {
        if ($value === '' || Validator::email()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid email: ' . $value);
    }
}
