<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;
use Respect\Validation\Validator as v;

class Datatype_ipv4 extends \Formularium\Datatype\Datatype_string
{
    public function __construct(string $typename = 'ipv4', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $faker = static::faker();
        return $faker->ipv4;
    }

    public function validate($value, array $validators = [], Model $model = null)
    {
        if ($value === '' || v::ip(FILTER_FLAG_IPV4)->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid IPV4'
        );
    }
}
