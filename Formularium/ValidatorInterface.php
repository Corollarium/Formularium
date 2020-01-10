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
     * @param Field $field
     * @param Model $model The entire model, if you your field depends on other things of the model. may be null.
     * @throws ValidatorException If invalid, with the message.
     * @return mixed
     */
    public function validate($value, Field $field, Model $model = null);
}
