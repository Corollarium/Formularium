<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\GraphQL;

use Exception;
use Formularium\Field;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\GraphQL\CodeGenerator as GraphQLCodeGenerator;
use Formularium\Datatype;
use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\DatatypeGeneratorFactory;

abstract class GraphQLDatatypeGenerator implements DatatypeGenerator
{
    protected function getDatatypeBasename(): string
    {
        return ucwords(DatatypeGeneratorFactory::getDatatypeName($this));
    }

    protected function getDatatype(): Datatype
    {
        return DatatypeFactory::factory(DatatypeGeneratorFactory::getDatatypeName($this));
    }

    public function getDatatypeName(GraphQLCodeGenerator $generator): string
    {
        return $generator->getDatatypeNamespace() . $this->getDatatypeBasename();
    }

    public function getBasetype(): string
    {
        return 'String';
    }

    public function datatypeDeclaration(CodeGenerator $generator)
    {
        /**
         * @var GraphQLCodeGenerator $generator
         */
        if (!is_a($generator, GraphQLCodeGenerator::class)) {
            throw new Exception("You need to pass a GraphQL\\CodeGenerator instance");
        }
        try {
            $className = get_class($this->getDatatype());
            $escapedClassName = str_replace("\\", "\\\\", $className);
            return 'scalar ' . $this->getDatatypeName($generator) . ' @scalar(class: "'. $escapedClassName . '")';
        } catch (\Throwable $e) {
            return '';
        }
    }

    public function field(CodeGenerator $generator, Field $field)
    {
        /**
         * @var GraphQLCodeGenerator $generator
         */
        $renderable = array_map(
            function ($name, $value) {
                $v = $value;
                if (is_string($value)) {
                    $v = '"' . str_replace('"', '\\"', $value) . '"';
                }
                return ' ' . $name . ': ' . $v;
            },
            array_keys($field->getRenderables()),
            $field->getRenderables()
        );

        return $field->getName() . ': ' . $this->getDatatypeName($generator)  .
            ($field->getValidatorOption(Datatype::REQUIRED, 'value', false) ? '!' : '') .
            // TODO: validators
            ($field->getRenderables() ? " @renderable(\n" . join("\n", $renderable) . "\n)" : '') .
            "\n";
    }

    public function variable(CodeGenerator $generator, Field $field): string
    {
        return $field->getName() . "\n";
    }
}
