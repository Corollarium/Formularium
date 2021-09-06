<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\GraphQL;

use Formularium\Field;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\Typescript\CodeGenerator as TypescriptCodeGenerator;
use Formularium\Datatype;
use Formularium\Factory\DatatypeGeneratorFactory;

abstract class GraphQLDatatypeGenerator implements DatatypeGenerator
{
    protected function getDatatypeBasename(): string
    {
        return ucwords(DatatypeGeneratorFactory::getDatatypeName($this));
    }

    public function getDatatypeName(TypescriptCodeGenerator $generator): string
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
         * @var TypescriptCodeGenerator $generator
         */
        return 'scalar ' . $this->getDatatypeName($generator) . ' @scalar(class: "Modelarium\\Types\\' . get_class($this) . '"';
    }

    public function field(CodeGenerator $generator, Field $field)
    {
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

        return $field->getName() . ': ' . $this->getBasetype() .
            ($field->getValidator(Datatype::REQUIRED, false) ? '' : '!') .
            // TODO: validators
            ($field->getRenderables() ? " @renderable(\n" . join("\n", $renderable) . "\n)" : '') .
            "\n";
    }
}
