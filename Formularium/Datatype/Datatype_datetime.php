<?php declare(strict_types=1);

namespace Formularium\Datatype;

use DateTime;
use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Respect\Validation\Validator;

class Datatype_datetime extends \Formularium\Datatype
{
    public const MIN = "min";
    public const MAX = "max";

    public function __construct(string $typename = 'datetime', string $basetype = 'datetime')
    {
        parent::__construct($typename, $basetype);
    }

    public static function time(int $time): string
    {
        return date('Y-m-d\TH:i:sP', $time);
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
        return $v->format(\DateTime::ISO8601);
    }

    public function validate($value, Field $field, Model $model = null)
    {
        if ($value === '') {
            return $value;
        }
        if (!is_string($value)) {
            throw new ValidatorException(
                'Invalid date time value. We expect ISO8601 format, got ' . htmlspecialchars(print_r($value, true))
            );
        }
        $dt = \DateTime::createFromFormat(\DateTime::ISO8601, $value);
        if (!$dt) {
            throw new ValidatorException(
                'Invalid date time value. We expect ISO8601 format, got ' . htmlspecialchars($value)
            );
        }
        return $dt->format(\DateTime::ISO8601);
    }


    public static function getValidatorMetadata(): array
    {
        return array_merge(
            parent::getValidatorMetadata(),
            [
                self::MIN => [
                    'comment' => "Minimum value.",
                    'args' => [
                        [
                            'name' => 'value',
                            'type' => 'Integer',
                            'comment' => 'The actual value'
                        ]
                    ]
                ],
                self::MAX => [
                    'comment' => "Maximum value.",
                    'args' => [
                        [
                            'name' => 'value',
                            'type' => 'Integer',
                            'comment' => 'The actual value'
                        ]
                    ]
                ]
            ]
        );
    }
}
