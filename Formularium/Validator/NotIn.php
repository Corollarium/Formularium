<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class NotIn implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if (in_array($value, $options['value'])) {
            throw new ValidatorException('Value is in list of forbidden values');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'NotIn',
            "Not in list",
            [
                new MetadataParameter(
                    'value',
                    '[String!]!',
                    'Value'
                )
            ]
        );
    }
}
