<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;

/**
 * May not be present, but if it is must not be empty.
 */
class Filled implements ValidatorInterface
{
    public function validate($value, array $options = [], Model $model = null)
    {
        // must be filled?
        if (empty($value)) {
            throw new ValidatorException("Field  must be filled");
        }

        return $value;
    }

    public function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'Filled',
            "Field may not be present, but if it is must not be empty."
        );
    }
}
