<?php declare(strict_types=1);

namespace Formularium\CodeGenerator;

use Formularium\Factory\DatatypeGeneratorFactory;
use Formularium\Field;
use Formularium\Model;

abstract class CodeGenerator
{
    public string $name;
    
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function datatypeDeclarations(): string
    {
        $classes = DatatypeGeneratorFactory::factoryAll($this);
        $declarations = array_map(
            fn ($c) => $c->datatypeDeclaration(),
            $classes
        );
        $cleanDeclarations = array_filter($declarations, fn ($d) => $d);
        return join("\n", $cleanDeclarations);
    }

    /**
     * Generates fields code for this model.
     *
     * @return mixed[]
     */
    public function fields(Model $model): array
    {
        $defs = [];
        foreach ($model->getFields() as $field) {
            $dg = DatatypeGeneratorFactory::factory($field->getDatatype(), $this);
            $defs[$field->getName()] = $dg->field($this, $field);
        }
        return $defs;
    }

    abstract public function type(Model $model): string;
}
