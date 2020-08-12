<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Equals implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        if ($value !== $options['value']) {
            throw new ValidatorException('Value is not the expected');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Equals',
            "Match exactly",
            [
                new MetadataParameter(
                    'value',
                    'String!',
                    'Value'
                )
            ]
        );
    }
}
