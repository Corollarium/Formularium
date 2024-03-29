<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\DatabaseEnum;
use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;

class Datatype_bool extends \Formularium\Datatype
{
    public function __construct(string $typename = 'bool', string $basetype = 'bool')
    {
        parent::__construct($typename, $basetype);
    }

    public function getDefault()
    {
        return false;
    }

    public function getRandom(array $params = [])
    {
        return (bool)rand(0, 1);
    }

    public function format($value)
    {
        return $value == true ? 'True' : 'False';
    }

    public function validate($value, Model $model = null)
    {
        if (is_string($value)) {
            if (strcasecmp($value, 'true') == 0 || $value == '1') {
                return true;
            } elseif (strcasecmp($value, 'false') == 0 || $value == '0') {
                return false;
            } else {
                throw new ValidatorException('Invalid boolean value');
            }
        } elseif (is_bool($value)) {
            return ($value === true);
        }
        throw new ValidatorException('Invalid boolean value');
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "boolean($name)";
    }

    public function getDocumentation(): string
    {
        return 'Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.';
    }
}
