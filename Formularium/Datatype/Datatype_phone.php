<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Respect\Validation\Validator as v;

class Datatype_phone extends Datatype_string
{
    public function __construct(string $typename = 'phone', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function validate($value, Model $model = null)
    {
        $value = parent::validate($value, $model);
        
        $value = mb_strtolower($value);

        if ($value === '' || v::phone()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid phone value' . $value);
    }

    public function getRandom(array $params = [])
    {
        return static::faker()->e164PhoneNumber;
    }

    public function getDocumentation(): string
    {
        return "A phone number in E164 format";
    }
}
