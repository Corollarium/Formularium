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
    public function validate($value, array $validators = [], Model $model = null)
    {
        // must be filled?
        if ($validators[self::class] ?? false) {
            if (empty($value)) {
                throw new ValidatorException("Field  must be filled");
            }
        }
        return $value;
    }
}
