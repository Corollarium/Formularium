<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript;

use Formularium\Field;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\Typescript\CodeGenerator as TypescriptCodeGenerator;

abstract class TypescriptDatatypeGenerator implements DatatypeGenerator
{
    protected function getDatatypeBasename(): string
    {
        $className = get_class($this);
        $datatypeName = mb_substr($className, mb_strrpos($className, '_') + 1);
        return $datatypeName;
    }

    public function getDatatype(TypescriptCodeGenerator $generator): string
    {
        return $generator->getDatatypeNamespace() . $this->getDatatypeBasename();
    }

    public function getBasetype(): string
    {
        return 'string';
    }

    public function datatypeDeclaration(CodeGenerator $generator)
    {
        /**
         * @var TypescriptCodeGenerator $generator
         */
        return 'type ' . $this->getDatatype($generator) . ' = ' . $this->getBasetype() . ';';
    }

    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var TypescriptCodeGenerator $generator
         */
        return $generator->fieldDeclaration($this->getDatatypeBasename(), $field->getName());
    }
}
