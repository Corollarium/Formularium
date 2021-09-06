<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\SQL\SQLDatatypeGenerator;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;
use Formularium\Datatype;
use Formularium\Datatype\Datatype_string;
use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\DatatypeGeneratorFactory;

class DatatypeGenerator_string extends SQLDatatypeGenerator
{
    protected string $basetype = 'VARCHAR';

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
         * @var SQLCodeGenerator $generator
         */
        return $this->getSQL(
            $field->getName(),
            $this->basetype . '(' . $this->maxLength() . ')',
            $field->getValidatorOption(Datatype::REQUIRED, 'value', false)
        );
    }
}
