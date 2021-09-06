<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Model;

use Formularium\Exception\ValidatorException;
use Respect\Validation\Validator as Respect;

class Datatype_cnpj extends \Formularium\Datatype\Datatype_string
{
    protected $MAX_STRING_LENGTH = '18';

    public function __construct(string $typename = 'cnpj', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $faker = static::faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
        return $faker->cnpj;
    }

    public function validate($value, Model $model = null)
    {
        if ($value === '' || Respect::cnpj()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid CNPJ');
    }

    public function getDocumentation(): string
    {
        return 'Datatype for Brazilian CNPJ document numbers.';
    }
}
