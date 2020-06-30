<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class MinLength implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if (!is_string($value)) {
            throw new ValidatorException('Expected a string.');
        }

        $minlength = $options['value'];
        if (mb_strlen($value) < $minlength) {
            throw new ValidatorException('String is too short.');
        }
        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'MinLength',
            "Minimum string length",
            [
                new ValidatorArgs(
                    'value',
                    'Int',
                    'Value'
                )
            ]
        );
    }
}
