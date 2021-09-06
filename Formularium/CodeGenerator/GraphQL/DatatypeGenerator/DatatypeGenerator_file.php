<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\GraphQL\DatatypeGenerator;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\GraphQL\GraphQLDatatypeGenerator;
use Formularium\Exception\ValidatorException;
use Formularium\Field;

class DatatypeGenerator_file extends GraphQLDatatypeGenerator
{
    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var SQLCodeGenerator $generator
         */
        throw new ValidatorException('File field.');
    }
}
