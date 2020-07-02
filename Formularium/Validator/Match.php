<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class Match implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        $ret = preg_match($options['regex'], $value);
        if ($ret === false) {
            throw new ValidatorException('Error, invalid regex.');
        } elseif ($ret === 0) {
            throw new ValidatorException('Value does not match regex.');
        }

        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'Match',
            "Matches against a regex",
            [
                new ValidatorArgs(
                    'value',
                    'String',
                    'Value'
                )
            ]
        );
    }
}
