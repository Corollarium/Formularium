<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

/**
 * Validates value contains only alphabetic characters.
 */
class Datatype_alpha extends \Formularium\Datatype\Datatype_string
{
    public function __construct(string $typename = 'alpha', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN_LENGTH] ?? 5;
        $max = $params[static::MAX_LENGTH] ?? 15;
        return static::getRandomString($min, $max, "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
    }

    public function validate($value, array $validators = [], Model $model = null)
    {
        $value = parent::validate($value, $validators, $model);
        if ($value !== '' && !preg_match('/^[\pL\pM]+$/u', $value)) {
            throw new ValidatorException('Use only alphabetic characters.' . $value);
        }
        return $value;
    }
}
