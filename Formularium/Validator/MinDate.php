<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Respect\Validation\Validator as Respect;

class MinDate implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        $min = $options['value'];
        // TODO: now
        $val = Respect::date('Y-m-d');
        $val->min($min);
        if (!$val->validate($value)) {
            throw new ValidatorException('Value is too small.');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'MinDate',
            "Minimum value for dates",
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
