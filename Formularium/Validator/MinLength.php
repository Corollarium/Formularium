<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;

class MinLength implements ValidatorInterface
{
    public function validate($value, array $validators = [], Model $model = null)
    {
        if (!is_string($value)) {
            throw new \Formularium\Exception\ValidatorException('Expected a string.');
        }

        $maxlength = $options['value'];
        if (mb_strlen($value) < $options[self::MIN_LENGTH]) {
            throw new \Formularium\Exception\ValidatorException('String is too short.');
        }
        return $value;
    }

    public function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            __CLASS__,
            "Minimum string length",
            [
                new ValidatorArgs(
                    'value',
                    'Integer',
                    'Value'
                )
            ]
        );
    }
}
