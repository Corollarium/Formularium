<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;
use Respect\Validation\Validator;

class Datatype_time extends \Formularium\Datatype
{
    public function __construct(string $typename = 'time', string $basetype = 'time')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $faker = static::faker();
        return $faker->time();
    }

    public function validate($value, array $validators = [], Model $model = null)
    {
        if ($value === '') {
            return $value;
        }

        $matches = [];
        if (preg_match("/^(\d{2}):(\d{2})(:(\d{2}))?$/", $value, $matches) === 1) {
            if (count($matches) == 3) {
                $matches[3] = 0;
            }
            if ($matches[1] < 24 && $matches[2] < 60 && $matches[3] < 60) {
                return $value;
            }
        }

        throw new ValidatorException(
            'Invalid time value. We expect this format: HH:MM:SS. ' . print_r($value, true)
        );
    }
}
