<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;

/**
 * The field under validation must be present and not empty only if all of the other specified fields are present.
 */
class RequiredWithAll implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if (!$model) {
            throw new ValidatorException("RequiredWith needs a model");
        }

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

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'RequiredWithAll',
            "The field under validation must be present and not empty only if all of the other specified fields are present.",
            [
                new MetadataParameter(
                    'fields',
                    '[String]',
                    'The fields that are required with'
                )
            ]
        );
    }
}
