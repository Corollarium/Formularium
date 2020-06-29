<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\Exception;
use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
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
        $min = $params[static::MIN]['value'] ?? self::fromString('-10 years');
        $max = $params[static::MAX]['value'] ?? self::fromString('+10 years');
        $faker = static::faker();
        $v = $faker->dateTimeBetween(
            $min,
            $max
        );
        return preg_replace('/T.+/', '', $v->format(\DateTime::ATOM));
    }

    public function validate($value, array $validators = [], Model $model = null)
    {
        if ($value === '') {
            return $value;
        }
        $val = Validator::date('Y-m-d');
        $min = $validators[static::MIN]['value'] ?? false;
        if ($min !== false) {
            $val->min($min);
        }
        $max = $validators[static::MAX]['value'] ?? false;
        if ($max !== false) {
            $val->max($max);
        }
        if ($val->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid date value. We expect this format: YYYY-MM-DD.' . print_r($value, true)
        );
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

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'DATE';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return 'date';
    }
}
