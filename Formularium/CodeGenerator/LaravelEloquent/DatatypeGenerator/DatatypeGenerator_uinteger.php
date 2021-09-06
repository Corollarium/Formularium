<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\LaravelEloquent\LaravelEloquentDatatypeGenerator;
use Formularium\CodeGenerator\LaravelEloquent\CodeGenerator as LaravelEloquentCodeGenerator;
use Formularium\Datatype;

class DatatypeGenerator_uinteger extends LaravelEloquentDatatypeGenerator
{
    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var LaravelEloquentCodeGenerator $generator
         */
        return "integer('{$field->getName()}')->unsigned()" .
            ($field->getValidatorOption(Datatype::REQUIRED, 'value', false) ? '' : '->nullable()');
    }
}
