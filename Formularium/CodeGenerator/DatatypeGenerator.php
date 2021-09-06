<?php declare(strict_types=1);

namespace Formularium\CodeGenerator;

use Formularium\Field;

interface DatatypeGenerator
{
    /**
     * Returns a datatype declaration, when your code generation needs to
     * declare a specific type for this datatype.
     *
     * @param CodeGenerator $generator
     * @return mixed
     */
    public function datatypeDeclaration(CodeGenerator $generator);

    /**
     * Generates a field declaration.
     *
     * @param CodeGenerator $generator
     * @param Field $field
     * @return mixed
     */
    public function field(CodeGenerator $generator, Field $field);
}
