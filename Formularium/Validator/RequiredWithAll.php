<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

/**
 * The field under validation must be present and not empty only if all of the other specified fields are present.
 */
class RequiredWithAll implements ValidatorInterface
{
    public function validate($value, array $options = [], Model $model = null)
    {
        $expectedFields = $options['fields'];
        if (!is_array($expectedFields)) {
            $expectedFields = [$expectedFields];
        }
        $found = true;
        $data = $model->getData();
        foreach ($expectedFields as $ef) {
            if (!array_key_exists($ef, $data)) {
                $found = false;
                break;
            }
        }

        if ($found && empty($value)) {
            throw new ValidatorException("Field is required when all fields " . implode(',', $expectedFields) . ' are present');
        }

        return $value;
    }

    public function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'RequiredWithAll',
            "The field under validation must be present and not empty only if all of the other specified fields are present.",
            [
                new ValidatorArgs(
                    'fields',
                    '[String]',
                    'The fields that are required with'
                )
            ]
        );
    }
}
