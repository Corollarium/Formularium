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
 * May not be present, but if it is must not be empty.
 */
class SameAs implements ValidatorInterface
{
    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if (!$model) {
            throw new ValidatorException('Same as requires a model.');
        }
        $modelData = $model->getData();

        $same = $options['target'];
        if (!array_key_exists($same, $modelData)) {
            throw new ValidatorException('Same as field not found.');
        }
        if ($modelData[$same] !== $value) {
            throw new ValidatorException('Field does not match ' . $same);
        }
        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'SameAs',
            "Must be the same as a target field.",
            [
                new MetadataParameter(
                    'target',
                    'String',
                    'Target field'
                )
            ]
        );
    }
}
