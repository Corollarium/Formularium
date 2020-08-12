<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;
use Respect\Validation\Validator as Respect;

class MaxDatetime implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        $max = $options['value'];
        $dt = \DateTime::createFromFormat(\DateTime::ISO8601, $value);
        $max = \DateTime::createFromFormat(\DateTime::ISO8601, $max);
        if ($dt > $max) {
            throw new ValidatorException('Value is too small.');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'MaxDatetime',
            "Maximum datetime value",
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
