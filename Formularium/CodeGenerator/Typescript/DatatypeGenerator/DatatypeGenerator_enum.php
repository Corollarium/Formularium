<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript\DatatypeGenerator;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\Typescript\CodeGenerator as TypescriptCodeGenerator;
use Formularium\CodeGenerator\Typescript\TypescriptDatatypeGenerator;

class DatatypeGenerator_enum extends TypescriptDatatypeGenerator
{
    public function datatypeDeclaration(CodeGenerator $generator)
    {
        /**
         * @var Datatype_enum $datatype
         */
        $datatype = $this->getDatatype();

        /**
         * @var TypescriptCodeGenerator $generator
         */

        $choices = $datatype->getChoices();

        return 'enum ' . $this->getDatatypeName($generator) . " {\n  " .
            implode("\n  ", array_keys($choices)) .
            "\n}";
        return $this->getBasetype() . ' ' . $this->getDatatypeName($generator) . ' { };';
    }

    public function getBasetype(): string
    {
        return 'enum';
    }
}