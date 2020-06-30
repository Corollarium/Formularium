<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class Min implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        $min = $options['value'];
        if ($datatype->getBasetype() === 'number') {
            if ($value < $min) {
                throw new ValidatorException('Value is too small.');
            }
        } elseif ($datatype->getBasetype() === 'date') {
            throw new ValidatorException('Type not supported in min validator: ' . $datatype->getBasetype());
        } elseif ($datatype->getBasetype() === 'datetime') {
            throw new ValidatorException('Type not supported in min validator: ' . $datatype->getBasetype());
        } else {
            throw new ValidatorException('Type not supported in min validator: ' . $datatype->getBasetype());
        }

        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'Min',
            "Minimum value",
            [
                new ValidatorArgs(
                    'value',
                    'Mixed',
                    'Value'
                )
            ]
        );
    }
}
