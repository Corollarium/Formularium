<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Respect\Validation\Validator as v;

class Datatype_domain extends Datatype_string
{
    public function __construct(string $typename = 'domain', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function validate($value, Field $field)
    {
        $value = parent::validate($value, $field);
        
        $value = mb_strtolower($value);

        if ($value === '' || v::domain()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid domain value');
    }

    public function getRandom(array $params = [])
    {
        return static::faker()->domainName;
    }
}
