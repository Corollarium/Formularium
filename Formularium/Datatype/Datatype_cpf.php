<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;

use Formularium\Exception\ValidatorException;
use Respect\Validation\Validator;

class Datatype_cpf extends \Formularium\Datatype\Datatype_string
{
    public function __construct(string $typename = 'cpf', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $faker = static::faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
        return $faker->cpf;
    }

    public function validate($value, array $validators = [], Model $model = null)
    {
        if ($value === '' || Validator::cpf()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid CPF');
    }
}
