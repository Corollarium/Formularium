<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript\DatatypeGenerator;

use Formularium\CodeGenerator\Typescript\TypescriptDatatypeGenerator;

class DatatypeGenerator_constant extends TypescriptDatatypeGenerator
{
    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var SQLCodeGenerator $generator
         */
        throw new ValidatorException('File field.');
    }
}
