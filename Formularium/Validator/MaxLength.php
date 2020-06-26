<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\ValidatorArgs;

class MaxLength implements ValidatorInterface
{
    public function validate($value, array $options = [], Model $model = null)
    {
        if (!is_string($value)) {
            throw new ValidatorException('Expected a string.');
        }
        $maxlength = $options['value'];
        if (mb_strlen($value) > $maxlength) {
            throw new ValidatorException('String is too long.');
        }
        return $value;
    }

    public function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'MaxLength',
            "Maximum string length",
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
