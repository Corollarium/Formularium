<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Exception\ValidatorException;
use Respect\Validation\Validator as v;

class Datatype_ipv6 extends \Formularium\Datatype\Datatype_string
{
    public function __construct(string $typename = 'ipv4', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $faker = static::faker();
        return $faker->ipv6;
    }

    public function validate($value, Field $field)
    {
        if ($value === '' || v::ip(FILTER_FLAG_IPV6)->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid IPV6'
        );
    }
}
