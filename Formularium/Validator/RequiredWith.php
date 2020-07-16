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
 * The field under validation must be present and not empty only if any of the other specified fields are present.
 */
class RequiredWith implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if (!$model) {
            throw new ValidatorException("RequiredWith needs a model");
        }

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

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'RequiredWith',
            "The field under validation must be present and not empty only if any of the other specified fields are present.",
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
