<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class MinDatetime implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        $min = $options['value'];
        // TODO: now
        $dt = \DateTime::createFromFormat(\DateTime::ISO8601, $value);
        $min = \DateTime::createFromFormat(\DateTime::ISO8601, $min);
        if ($dt < $min) {
            throw new ValidatorException('Value is too small.');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'MinDatetime',
            "Minimum value for datetimes",
            [
                new MetadataParameter(
                    'value',
                    'Datetime',
                    'Value'
                )
            ]
        );
    }
}
