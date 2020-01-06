<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\Exception;
use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Respect\Validation\Validator;

class Datatype_date extends \Formularium\Datatype
{
    public const MIN = "min";
    public const MAX = "max";

    public function __construct(string $typename = 'date', string $basetype = 'date')
    {
        parent::__construct($typename, $basetype);
    }

    /**
     * Wrapper for strotime()
     *
     * @throws Exception
     * @param string $time
     * @return string
     */
    public static function fromString(string $time): string
    {
        $t = strtotime($time);
        if ($t === false) {
            throw new Exception('Invalid date.');
        }
        return date('Y-m-d', $t);
    }

    public static function fromUnix(int $time): string
    {
        return date('Y-m-d', $time);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN] ?? self::fromString('-10 years');
        $max = $params[static::MAX] ?? self::fromString('+10 years');
        $faker = static::faker();
        $v = $faker->dateTimeBetween(
            $min,
            $max
        );
        return preg_replace('/T.+/', '', $v->format(\DateTime::ATOM));
    }

    public function validate($value, Field $f)
    {
        if ($value === '') {
            return $value;
        }
        $val = Validator::date();
        $min = $f->getValidator(static::MIN, false);
        if ($min) {
            $val->min($min);
        }
        $max = $f->getValidator(static::MAX, false);
        if ($max) {
            $val->max($max);
        }
        if ($val->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid date value. We expect this format: YYYY-MM-DD.' . print_r($value, true)
        );
    }
}
