<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\SQL\SQLDatatypeGenerator;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;
use Formularium\Exception\ValidatorException;

class DatatypeGenerator_file extends SQLDatatypeGenerator
{
    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var SQLCodeGenerator $generator
         */
        throw new ValidatorException('File field.');
    }
}
