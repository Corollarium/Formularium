<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ValidatorException;

/**
 * Abstract base classe to validate data in composition to the validation in
 * datatypes.
 */
interface ValidatorInterface
{
    /**
     * Checks if $value is a valid value for this datatype considering the validators.
     *
     * @param mixed $value
     * @param array $options
     * @param Model $model The entire model. Useful if validation depends on other fields. May be null.
     * @throws ValidatorException Thrown if invalid, with the message.
     * @return mixed The $value, with possible changes from the validation.
     */
    public static function validate($value, array $options = [], ?Model $model = null);

    /**
     * Documents this validator.
     *
     * @return Metadata
     */
    public static function getMetadata(): Metadata;
}
