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
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        $min = $options['value'];
        if ($datatype->getBasetype() === 'number' || $datatype->getBasetype() === 'integer') {
            if ($value < $min) {
                throw new ValidatorException('Value is too small.');
            }
        } elseif (
            $datatype->getBasetype() === 'date'
        ) {
            // TODO: now
            $val = Respect::date('Y-m-d');
            $val->min($min);
            if (!$val->validate($value)) {
                throw new ValidatorException('Value is too small.');
            }
        } elseif (
            $datatype->getBasetype() === 'datetime'
        ) {
            // TODO: now
            $dt = \DateTime::createFromFormat(\DateTime::ISO8601, $value);
            $min = \DateTime::createFromFormat(\DateTime::ISO8601, $min);
            if ($dt < $min) {
                throw new ValidatorException('Value is too small.');
            }
        } else {
            throw new ValidatorException('Type not supported in min validator: ' . $datatype->getBasetype());
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
                    'Int', // TODO: Mixed
                    'Value'
                )
            ]
        );
    }
}
