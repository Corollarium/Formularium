<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

/**
 * Validates value contains only alpha-numeric characters.
 */
class Datatype_alphanum extends \Formularium\Datatype\Datatype_string
{
    public function __construct(string $typename = 'alphanum', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN_LENGTH] ?? 5;
        $max = $params[static::MAX_LENGTH] ?? 15;
        return static::getRandomString($min, $max, "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
    }

    public function validate($value, Model $model = null)
    {
        $value = parent::validate($value, $model);
        if ($value !== '' && !preg_match('/^[\pL\pM\pN]+$/u', $value)) {
            throw new ValidatorException('Use only alpha-numeric characters, dashes, and underscores.');
        }
        return $value;
    }
}
