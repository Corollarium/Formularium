<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class Max implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        $max = $options['value'];
        if ($datatype->getBasetype() === 'number') {
            if ($value > $max) {
                throw new ValidatorException('Value is too small.');
            }
        } elseif (
            $datatype->getBasetype() === 'date' ||
            $datatype->getBasetype() === 'datetime'
        ) {
            $dt = \DateTime::createFromFormat(\DateTime::ISO8601, $value);
            $max = \DateTime::createFromFormat(\DateTime::ISO8601, $max);
            if ($dt > $max) {
                throw new ValidatorException('Value is too small.');
            }
        } else {
            throw new ValidatorException('Type not supported in min validator: ' . $datatype->getBasetype());
        }

        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'Max',
            "Maximum value",
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
