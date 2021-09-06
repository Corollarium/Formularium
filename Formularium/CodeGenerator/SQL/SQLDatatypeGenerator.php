<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL;

use Formularium\Field;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\Typescript\CodeGenerator as TypescriptCodeGenerator;
use Formularium\Datatype;

abstract class SQLDatatypeGenerator implements DatatypeGenerator
{
    public function datatypeDeclaration(CodeGenerator $generator)
    {
        /**
         * @var SQLCodeGenerator $generator
         */
        return '';
    }

    protected function getSQL(string $fieldName, string $qualifier, bool $nullable = true) : string
    {
        return $fieldName . ($qualifier ? ' ' . $qualifier : '') . ($nullable ? '' : ' NOT NULL');
    }
}
