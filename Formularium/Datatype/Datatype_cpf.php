<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;

use Formularium\Exception\ValidatorException;
use Formularium\Validator\MaxLength;
use Formularium\Validator\MinLength;
use Respect\Validation\Validator as Respect;

class Datatype_cpf extends \Formularium\Datatype\Datatype_string
{
    protected $MIN_STRING_LENGTH = 8;
    protected $MAX_STRING_LENGTH = 13;

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

    public function validate($value, Model $model = null)
    {
        if ($value === '' || Respect::cpf()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid CPF');
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
        ];
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "string($name, 13)";
    }

    public function getDocumentation(): string
    {
        return 'Datatype for Brazilian CPF document numbers.';
    }
}
