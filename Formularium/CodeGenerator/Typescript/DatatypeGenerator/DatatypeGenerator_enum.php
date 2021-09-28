<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript\DatatypeGenerator;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\Typescript\CodeGenerator as TypescriptCodeGenerator;
use Formularium\CodeGenerator\Typescript\TypescriptDatatypeGenerator;
use Formularium\Datatype\Datatype_enum;

class DatatypeGenerator_enum extends TypescriptDatatypeGenerator
{
    public function datatypeDeclaration(CodeGenerator $generator)
    {
        try {
            /**
             * @var Datatype_enum $datatype
             */
            $datatype = $this->getDatatype();

            /**
             * @var TypescriptCodeGenerator $generator
             */

            $choices = $datatype->getChoices();

            $choicesTS = array_map(
                function ($c) {
                    return "  \"$c\" = \"$c\"";
                },
                array_keys($choices)
            );
            return 'enum ' . $this->getDatatypeName($generator) . " {\n" .
                implode(",\n", $choicesTS) .
                "\n}";
        } catch (\Throwable $e) {
            return '';
        }
    }

    public function getBasetype(): string
    {
        return 'enum';
    }
}
