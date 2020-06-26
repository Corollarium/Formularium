<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class MinLength implements ValidatorInterface
{
    public function validate($value, array $options = [], Model $model = null)
    {
        if (!is_string($value)) {
            throw new \Formularium\Exception\ValidatorException('Expected a string.');
        }

        $minlength = $options['value'];
        if (mb_strlen($value) < $minlength) {
            throw new \Formularium\Exception\ValidatorException('String is too short.');
        }
        return $value;
    }

    public function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'MinLength',
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
