<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;

/**
 * May not be present, but if it is must not be empty.
 */
class Filled implements ValidatorInterface
{
    public function validate($value, Field $field, Model $model = null)
    {
        // must be filled?
        if ($field->getValidators()[self::class] ?? false) {
            if (empty($value)) {
                throw new ValidatorException("Field {$field->getName()} must be filled");
            }
        }
        return $value;
    }
}
