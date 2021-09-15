<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript\DatatypeGenerator;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\Typescript\TypescriptDatatypeGenerator;
use Formularium\Exception\ValidatorException;
use Formularium\Field;

class DatatypeGenerator_constant extends TypescriptDatatypeGenerator
{
    public function field(CodeGenerator $generator, Field $field)
    {
        throw new ValidatorException('Constant field.');
    }
}
