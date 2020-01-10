<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;

/**
 * The field under validation must be present and not empty only if all of the other specified fields are present.
 */
class RequiredWithAll implements ValidatorInterface
{
    public function validate($value, Field $field, Model $model = null)
    {
        if ($field->getValidators()[self::class] ?? false) {
            $expectedFields = $field->getValidators()[self::class];
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
                $name = $field->getName();
                throw new ValidatorException("Field $name is required when all fields " . implode(',', $expectedFields) . ' are present');
            }
        }
        return $value;
    }
}
