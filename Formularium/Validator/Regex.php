<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Model;
use Formularium\ValidatorArgs;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\Exception\ValidatorException;

class Regex implements ValidatorInterface
{
    /**
     * Checks if $value is a valid value for this datatype considering the validators.
     *
     * @param mixed $value
     * @param array $options The options passed to the validator
     * @param Datatype $datatype The datatype being validator.
     * @param Model $model The entire model, if you your field depends on other things of the model. may be null.
     * @throws ValidatorException If invalid, with the message.
     * @return mixed
     */
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if (preg_match($options['value'], $value)) {
            return $value;
        }
        throw new ValidatorException('Value does not match expected regular expression');
    }

    /**
     * Documents this validator.
     *
     * @return ValidatorMetadata
     */
    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'Regex',
            "Regular expression validator",
            [
                new ValidatorArgs(
                    'value',
                    'String',
                    'Regular expression, PHP style'
                )
            ]
        );
    }
}
