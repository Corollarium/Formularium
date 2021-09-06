<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\LaravelEloquent\CodeGenerator as LaravelEloquentCodeGenerator;
use Formularium\CodeGenerator\LaravelEloquent\LaravelEloquentDatatypeGenerator;
use Formularium\Exception\ValidatorException;

class DatatypeGenerator_constant extends LaravelEloquentDatatypeGenerator
{
    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var LaravelEloquentCodeGenerator $generator
         */
        throw new ValidatorException('File field.');
    }
}
