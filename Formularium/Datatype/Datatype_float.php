<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Respect\Validation\Validator as V;

class Datatype_float extends \Formularium\Datatype\Datatype_number
{
    public function __construct(string $typename = 'float', string $basetype = 'number')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN] ?? 0.0;
        $max = $params[static::MAX] ?? 1.0;
       
        if ($min > $max) {
            throw new ValidatorException('Minimum value greater than the maximum value');
        }
        if ($min == $max) {
            throw new ValidatorException('Minimum value equal to the maximum value');
        }
        $rand = mt_rand() / mt_getrandmax();
        $rand = $min + $rand * ($max - $min);
        return (float)number_format($rand, 3);
    }

    public function validate($value, array $validators = [], Model $model = null)
    {
        if (is_float($value) || V::floatVal()->validate($value)) {
            return $value;
        } elseif ($value == '') {
            return null;
        }
        throw new ValidatorException('Invalid float value');
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
                            'type' => 'Float',
                            'comment' => 'The actual value'
                        ]
                    ]
                ],
                self::MAX => [
                    'comment' => "Maximum value.",
                    'args' => [
                        [
                            'name' => 'value',
                            'type' => 'Float',
                            'comment' => 'The actual value'
                        ]
                    ]
                ]
            ]
        );
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'FLOAT';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "float('$name')";
    }
}
