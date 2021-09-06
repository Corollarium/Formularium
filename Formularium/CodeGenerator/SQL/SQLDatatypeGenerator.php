<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL;

use Formularium\Field;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;
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

    protected function getSQL(string $fieldName, string $qualifier, bool $required = false) : string
    {
        return $fieldName . ($qualifier ? ' ' . $qualifier : '') . ($required ? ' NOT NULL' : '');
    }
}
