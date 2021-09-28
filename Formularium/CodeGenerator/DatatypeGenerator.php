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
     * Generates a field declaration. This is used to create type declarations,
     * such as classes for PHP, types for GraphQL, interfaces for Typescript. It
     * usually will include the datatype and more.
     *
     * @param CodeGenerator $generator
     * @param Field $field
     * @return string|string[]
     */
    public function field(CodeGenerator $generator, Field $field);

    /**
     * Returns a variable declaration. This is used to generate actual code, not
     * the declaration like field(). Examples: queries for GraphQL. The
     * CodeGenerator may ignore this and return empty strings.
     *
     * @param CodeGenerator $generator
     * @param Field $field
     * @return string
     */
    public function variable(CodeGenerator $generator, Field $field): string;
}
