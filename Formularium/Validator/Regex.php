<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Model;
use Formularium\MetadataParameter;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\Exception\ValidatorException;

class Regex implements ValidatorInterface
{
    /**
     * Checks if $value is a valid value for this datatype considering the validators.
     *
     * @param mixed $value
     * @param array $options The options passed to the validator
     * @throws ValidatorException If invalid, with the message.
     * @return mixed
     */
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        $ret = 0;
        try {
            $ret = preg_match($options['value'], $value);
        } catch (\Exception $e) {
            throw new ValidatorException('Error, invalid regex.');
        }
        if ($ret === false || $ret === 0) {
            throw new ValidatorException('Value does not match regex.');
        }

        return $value;
    }

    /**
     * Documents this validator.
     *
     * @return Metadata
     */
    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Regex',
            "Regular expression validator",
            [
                new MetadataParameter(
                    'value',
                    'String',
                    'Regular expression, PHP style'
                )
            ]
        );
    }
}
