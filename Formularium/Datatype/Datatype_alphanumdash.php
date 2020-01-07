<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

/**
 * Validates value contains only alpha-numeric characters, dashes, and underscores.
 */
class Datatype_alphanumdash extends \Formularium\Datatype\Datatype_string
{
    public function __construct(string $typename = 'alphanumdash', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN_LENGTH] ?? 5;
        $max = $params[static::MAX_LENGTH] ?? 15;
        return static::getRandomString($min, $max, "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-");
    }

    public function validate($value, Field $field, Model $model = null)
    {
        $value = parent::validate($value, $field, $model);
        if ($value !== '' && !preg_match('/^[\pL\pM\pN_-]+$/u', $value)) {
            throw new ValidatorException('Use only alpha-numeric characters, dashes, and underscores.');
        }
        return $value;
    }
}
