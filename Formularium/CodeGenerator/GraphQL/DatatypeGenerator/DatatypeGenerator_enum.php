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
        /**
         * @var Datatype_enum $datatype
         */
        $datatype = $this->getDatatype();

        /**
         * @var GraphQLCodeGenerator $generator
         */

        $choices = $datatype->getChoices();

        return 'enum ' . $this->getDatatypeName($generator) . " {\n  " .
            implode("\n  ", array_keys($choices)) .
            "\n}";
    }
}
