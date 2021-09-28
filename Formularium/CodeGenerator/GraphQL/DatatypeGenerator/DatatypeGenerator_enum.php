<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\GraphQL\DatatypeGenerator;

use Formularium\CodeGenerator\GraphQL\GraphQLDatatypeGenerator;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\GraphQL\CodeGenerator as GraphQLCodeGenerator;
use Formularium\Datatype\Datatype_enum;

class DatatypeGenerator_enum extends GraphQLDatatypeGenerator
{
    public function datatypeDeclaration(CodeGenerator $generator)
    {
        try {
            /**
         * @var Datatype_enum $datatype
         */
            $datatype = $this->getDatatype();

            /**
             * @var GraphQLCodeGenerator $generator
             */

            $choices = $datatype->getChoices();

            $choicesEscaped = array_map(
                function ($c) {
                    $c = preg_replace("/[^A-Za-z0-9]+/s", "_", $c);
                    return ((ctype_alpha($c[0]) || $c[0] === '_') ? $c : '_' . $c);
                },
                array_keys($choices)
            );

            return 'enum ' . $this->getDatatypeName($generator) . " {\n  " .
                implode("\n  ", $choicesEscaped) .
                "\n}";
        } catch (\Throwable $e) {
            return '';
        }
    }
}
