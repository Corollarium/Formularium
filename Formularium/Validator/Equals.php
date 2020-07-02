<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class Equals implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if ($value !== $options['value']) {
            throw new ValidatorException('Value is not the expected');
        }

        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'Equals',
            "Match exactly",
            [
                new ValidatorArgs(
                    'value',
                    'String!',
                    'Value'
                )
            ]
        );
    }
}
