<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class NotIn implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if (in_array($value, $options['value'])) {
            throw new ValidatorException('Value is in list of forbidden values');
        }

        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'NotIn',
            "Not in list",
            [
                new ValidatorArgs(
                    'value',
                    '[String!]!',
                    'Value'
                )
            ]
        );
    }
}
