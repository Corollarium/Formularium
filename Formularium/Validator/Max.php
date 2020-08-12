<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Respect\Validation\Validator as Respect;

class Max implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        $max = $options['value'];
        if ($value > $max) {
            throw new ValidatorException('Value is too large.');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Max',
            "Maximum value",
            [
                new MetadataParameter(
                    'value',
                    'Int|Float', // TODO: Mixed
                    'Value'
                )
            ]
        );
    }
}
