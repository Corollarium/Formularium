<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Model;
use Formularium\ValidatorArgs;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\Exception\ValidatorException;
use Formularium\Validator\MinLength;

class Password implements ValidatorInterface
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
        MinLength::validate($value, ['value' => $options['minLength'] ?? 6], $datatype, $model);

        $entropy = 0;
        $size = mb_strlen($value);
        foreach (count_chars($value, 1) as $frequency) {
            $p = $frequency / $size;
            $entropy -= $p * log($p) / log(2);
        }
        if ($entropy < ($options['entropy'] ?? 2)) {
            throw new ValidatorException('You must choose more complex password.');
        }
        return $value;
    }

    /**
     * Documents this validator.
     *
     * @return ValidatorMetadata
     */
    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'Password',
            "Validates passwords",
            [
                new ValidatorArgs(
                    'minLength',
                    'Int',
                    'Minimum password length'
                ),
                new ValidatorArgs(
                    'entropy',
                    'Float',
                    'Minimum entropy. Default: 2'
                ),
            ]
        );
    }
}
