<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;

/**
 * The field under validation must be present and not empty only if any of the other specified fields are present.
 */
class RequiredWith implements ValidatorInterface
{
    public function validate($value, Field $field, Model $model = null)
    {
        if ($field->getValidators()[self::class] ?? false) {
            $expectedFields = $field->getValidators()[self::class];
            if (!is_array($expectedFields)) {
                $expectedFields = [$expectedFields];
            }
            $found = false;
            $data = $model->getData();
            foreach ($expectedFields as $ef) {
                if (array_key_exists($ef, $data) && !empty($data[$ef])) {
                    $found = true;
                    break;
                }
            }
            if ($found && empty($value)) {
                $name = $field->getName();
                throw new ValidatorException("Field $name is required when at least one of fields " . implode(',', $expectedFields) . ' are present');
            }
        }
        return $value;
    }
}
