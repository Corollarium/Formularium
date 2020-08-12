<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Respect\Validation\Validator as Respect;

class MaxDate implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        $max = $options['value'];
        $val = Respect::date('Y-m-d');
        $val->max($max);
        if (!$val->validate($value)) {
            throw new ValidatorException('Value is too large.');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'MaxDate',
            "Maximum date value",
            [
                new MetadataParameter(
                    'value',
                    'Date',
                    'Value'
                )
            ]
        );
    }
}
