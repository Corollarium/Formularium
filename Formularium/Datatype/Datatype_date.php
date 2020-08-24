<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\Exception;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Respect\Validation\Validator as Respect;

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

    public function validate($value, Model $model = null)
    {
        if ($value === '') {
            return $value;
        }
        $val = Respect::date('Y-m-d');
        if ($val->validate($value)) {
            return $value;
        }
        throw new ValidatorException(
            'Invalid date value. We expect this format: YYYY-MM-DD.' . print_r($value, true)
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

    public function getDocumentation(): string
    {
        return 'Dates in ISO format: YYYY-MM-DD.';
    }
}
