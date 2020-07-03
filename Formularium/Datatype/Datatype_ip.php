<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;
use Respect\Validation\Validator as v;

class Datatype_ip extends \Formularium\Datatype\Datatype_string
{
    public function __construct(string $typename = 'ip', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $faker = static::faker();
        return ((bool)rand(0, 1)) ? $faker->ipv4 : $faker->ipv6;
    }

    public function validate($value, Model $model = null)
    {
        if ($value === '' || v::ip(FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid IP'
        );
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'VARCHAR(39)';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "ipAdddress('$name')";
    }
}
