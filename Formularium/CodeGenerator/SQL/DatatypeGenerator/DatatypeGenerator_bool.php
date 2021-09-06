<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;
use Formularium\CodeGenerator\SQL\SQLDatatypeGenerator as SQLSQLDatatypeGenerator;
use Formularium\DatabaseEnum;

class DatatypeGenerator_bool extends SQLSQLDatatypeGenerator
{
    protected function _type(CodeGenerator $generator)
    {
        /**
         * @var SQLCodeGenerator $generator
         */
        switch ($generator->database) {
            case DatabaseEnum::MYSQL:
                return 'BOOLEAN';
            case DatabaseEnum::POSTGRESQL:
                return 'BOOLEAN';
            case DatabaseEnum::ORACLE:
                return 'NUMBER(1)';
            case DatabaseEnum::SQLSERVER:
                return 'BIT';
        }
        return 'INT';
    }

    public function field(CodeGenerator $generator, Field $field)
    {
        return $field->getName() . ' '. $this->_type($generator);
    }
}
