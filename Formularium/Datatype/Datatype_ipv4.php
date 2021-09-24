<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;
use Formularium\Validator\MaxLength;
use Formularium\Validator\MinLength;
use Formularium\Validator\Regex;
use Respect\Validation\Validator as v;

class Datatype_ipv4 extends \Formularium\Datatype\Datatype_string
{
    protected $MIN_STRING_LENGTH = 7;

    protected $MAX_STRING_LENGTH = 15;

    public function __construct(string $typename = 'ipv4', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $faker = static::faker();
        return $faker->ipv4;
    }

    public function validate($value, Model $model = null)
    {
        if ($value === '' || v::ip(FILTER_FLAG_IPV4)->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid IPV4'
        );
    }

    public function getValidators(): array
    {
        return [
            MinLength::class => [
                'value' => $this->MIN_STRING_LENGTH
            ],
            MaxLength::class => [
                'value' => $this->MAX_STRING_LENGTH
            ],
            Regex::class => [
                'value' => '/^((25[0-5]|(2[0-4]|1\d|[1-9]|)\d)(\.(?!$)|$)){4}$/'
            ],
        ];
    }

    public function getDocumentation(): string
    {
        return 'Datatype for IPs in IPV4 format';
    }
}
