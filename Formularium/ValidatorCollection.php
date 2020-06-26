<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\ValidatorException;

/**
 * Abstract base classe to validate data in composition to the validation in
 * datatypes.
 */
class Validator
{
    /**
     * Factory.
     *
     */
    public static function factory(string $validatorName): ValidatorInterface
    {
        $class = "\\Formularium\\Validator\\$validatorName";
        if (!class_exists($class)) {
            $class = "$validatorName";
            if (!class_exists($class)) {
                throw new ClassNotFoundException("Invalid datatype validator $validatorName");
            }
        }
        return new $class();
    }
}
