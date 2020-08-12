<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;

/**
 * May not be present, but if it is must not be empty.
 */
class Filled implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        // must be filled?
        if (empty($value)) {
            throw new ValidatorException("Field  must be filled");
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Filled',
            "Field may not be present, but if it is must not be empty."
        );
    }
}
