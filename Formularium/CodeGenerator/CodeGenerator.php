<?php declare(strict_types=1);

namespace Formularium\CodeGenerator;

use Formularium\Datatype;
use Formularium\Factory\DatatypeGeneratorFactory;
use Formularium\Field;
use Formularium\Model;

abstract class CodeGenerator
{
    /**
     * @var string
     */
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function datatypeDeclarations(): string
    {
        $classes = DatatypeGeneratorFactory::specializedFactoryAll($this);
        $declarations = array_map(
            function (DatatypeGenerator $c) {
                return $c->datatypeDeclaration($this);
            },
            $classes
        );
        $cleanDeclarations = array_filter($declarations, function ($d) {
            return $d;
        });
        return join("\n", $cleanDeclarations);
    }

    /**
     * Returns a single declaration for a specific datatype.
     *
     * @param Datatype $datatype
     * @return string
     */
    public function datatypeDeclaration(Datatype $datatype): string
    {
        $generator = DatatypeGeneratorFactory::specializedFactory($datatype, $this);
        return $generator->datatypeDeclaration($this);
    }

    /**
     * Generates fields code for this model.
     *
     * @return string[]
     */
    public function fields(Model $model): array
    {
        $defs = [];
        foreach ($model->getFields() as $field) {
            $d = $this->field($field);
            if (is_array($d)) {
                $defs += $d;
            } elseif (is_string($d)) {
                $defs[$field->getName()] = $d;
            }
        }
        return $defs;
    }

    /**
     * Generates fields code for this model.
     *
     * @return string|string[]
     */
    public function field(Field $field)
    {
        $dg = DatatypeGeneratorFactory::specializedFactory($field->getDatatype(), $this);
        return $dg->field($this, $field);
    }

    abstract public function type(Model $model): string;

    abstract public function typeFilename(Model $model): string;
}
