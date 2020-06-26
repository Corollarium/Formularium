<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;

use Formularium\Exception\ValidatorException;
use Respect\Validation\Validator;

class Datatype_cnpj extends \Formularium\Datatype\Datatype_string
{
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

    public function validate($value, array $validators = [], Model $model = null)
    {
        if ($value === '' || Validator::cnpj()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid CNPJ');
    }
}
