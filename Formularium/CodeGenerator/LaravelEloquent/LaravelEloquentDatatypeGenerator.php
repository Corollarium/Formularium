<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent;

use Formularium\Field;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\LaravelEloquent\CodeGenerator as LaravelEloquentCodeGenerator;
use Formularium\Datatype;

abstract class LaravelEloquentDatatypeGenerator implements DatatypeGenerator
{
    public function datatypeDeclaration(CodeGenerator $generator)
    {
        /**
         * @var LaravelEloquentCodeGenerator $generator
         */
        return '';
    }

    public function variable(CodeGenerator $generator, Field $field): string
    {
        return '';
    }
}
