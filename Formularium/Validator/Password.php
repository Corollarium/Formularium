<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Model;
use Formularium\MetadataParameter;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
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
     * @return Metadata
     */
    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Password',
            "Validates passwords",
            [
                new MetadataParameter(
                    'minLength',
                    'Int',
                    'Minimum password length'
                ),
                new MetadataParameter(
                    'entropy',
                    'Float',
                    'Minimum entropy. Default: 2'
                ),
            ]
        );
    }
}
