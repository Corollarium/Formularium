<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\LaravelEloquent\CodeGenerator as LaravelEloquentCodeGenerator;
use Formularium\CodeGenerator\LaravelEloquent\LaravelEloquentDatatypeGenerator;
use Formularium\Datatype;
use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\DatatypeGeneratorFactory;

class DatatypeGenerator_string extends LaravelEloquentDatatypeGenerator
{
    protected string $basetype = 'string';

    protected function maxLength(): int
    {
        /**
         * @var Datatype_string
         */
        $dt = DatatypeFactory::factory(DatatypeGeneratorFactory::getDatatypeName($this));
        return $dt->getMaxStringLength();
    }

    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var LaravelEloquentCodeGenerator $generator
         */
        return "{$this->basetype}('{$field->getName()}', {$this->maxLength()})" .
            ($field->getValidatorOption(Datatype::REQUIRED, 'value', false) ? '' : '->nullable()');
    }
}
