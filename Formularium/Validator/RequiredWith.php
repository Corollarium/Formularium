<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;

/**
 * The field under validation must be present and not empty only if any of the other specified fields are present.
 */
class RequiredWith implements ValidatorInterface
{
    public function validate($value, array $options = [], Model $model = null)
    {
        $expectedFields = $options['fields'];

        $found = false;
        $data = $model->getData();
        foreach ($expectedFields as $ef) {
            if (array_key_exists($ef, $data) && !empty($data[$ef])) {
                $found = true;
                break;
            }
        }
        if ($found && empty($value)) {
            throw new ValidatorException("Field is required when at least one of fields " . implode(',', $expectedFields) . ' are present');
        }
        return $value;
    }

    public function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            __CLASS__,
            "The field under validation must be present and not empty only if any of the other specified fields are present.",
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
