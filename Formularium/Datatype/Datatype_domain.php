<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Respect\Validation\Validator as v;

class Datatype_domain extends Datatype_string
{
    public function __construct(string $typename = 'domain', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function validate($value, Model $model = null)
    {
        $value = parent::validate($value, $model);
        
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

    public function getDocumentation(): string
    {
        return 'Internet domain names.';
    }
}
