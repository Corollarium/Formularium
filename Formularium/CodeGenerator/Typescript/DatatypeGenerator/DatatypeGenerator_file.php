<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript\DatatypeGenerator;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\Typescript\TypescriptDatatypeGenerator;
use Formularium\Exception\ValidatorException;
use Formularium\Field;

class DatatypeGenerator_file extends TypescriptDatatypeGenerator
{
    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var SQLCodeGenerator $generator
         */
        throw new ValidatorException('File field.');
    }
}
