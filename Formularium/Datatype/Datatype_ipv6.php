<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;
use Respect\Validation\Validator as v;

class Datatype_ipv6 extends \Formularium\Datatype\Datatype_string
{
    /**
     *  @var integer
     */
    protected $MAX_STRING_LENGTH = 39;

    public function __construct(string $typename = 'ipv6', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $faker = static::faker();
        return $faker->ipv6;
    }

    public function validate($value, Model $model = null)
    {
        if ($value === '' || v::ip(FILTER_FLAG_IPV6)->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid IPV6'
        );
    }

    public function getDocumentation(): string
    {
        return 'Datatype for IPs in IPV6 format';
    }
}
