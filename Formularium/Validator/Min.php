<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Respect\Validation\Validator as Respect;

class Min implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        $min = $options['value'];
        if ($value < $min) {
            throw new ValidatorException('Value is too small.');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Min',
            "Minimum value",
            [
                new MetadataParameter(
                    'value',
                    'Int|Float',
                    'Value'
                )
            ]
        );
    }
}
