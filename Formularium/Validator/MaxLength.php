<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class MaxLength implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if (!is_string($value)) {
            throw new ValidatorException('Expected a string.');
        }
        $maxlength = $options['value'];
        if (mb_strlen($value) > $maxlength) {
            throw new ValidatorException('String is too long.');
        }
        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'MaxLength',
            "Maximum string length",
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