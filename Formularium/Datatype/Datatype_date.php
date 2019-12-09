<?php

namespace Formularium\Datatype;

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

    public static function time(int $time): string
    {
        return date('Y-m-d', $time);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN] ?? self::time(strtotime('-10 years'));
        $max = $params[static::MAX] ?? self::time(strtotime('+10 years'));
        $faker = static::faker();
        $v = $faker->dateTimeBetween(
            $min,
            $max
        );
        return preg_replace('/T.+/', '', $v->format(\DateTime::ATOM));
    }

    public function validate($value, Field $f)
    {
        if ($value === '' || Validator::date()->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid date value. We expect this format: YYYY-MM-DD.' . print_r($value, true)
        );
    }
}
