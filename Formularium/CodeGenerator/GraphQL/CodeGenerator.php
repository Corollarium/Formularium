<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\GraphQL;

use Formularium\Factory\DatatypeGeneratorFactory;
use Formularium\Field;
use Formularium\Model;

class CodeGenerator extends \Formularium\CodeGenerator\CodeGenerator
{
    /**
     * Prefixes datatypes with a namespace
     *
     * @var string
     */
    public $datatypeNamespace = '';

    public function __construct(string $name = 'GraphQL')
    {
        parent::__construct($name);
    }

    public function type(Model $model): string
    {
        $defs = $this->fields($model);

        $renderables = $model->getRenderables();
        $r = array_map(
            function ($name, $value) {
                $v = $value;
                if (is_string($value)) {
                    $v = '"' . str_replace('"', '\\"', $value) . '"';
                }
                return ' ' . $name . ': ' . $v;
            },
            array_keys($renderables),
            $renderables
        );

        return 'type ' . $model->getName() .
            ($model->renderable ? join("\n", $r) : '') .
            " {\n  " .
            str_replace("\n", "\n  ", join("", $defs)) .
            "\n}\n\n";
    }

    /**
     * Generates fields code for this model.
     *
     * @return string
     */
    public function variable(Field $field): string
    {
        $dg = DatatypeGeneratorFactory::specializedFactory($field->getDatatype(), $this);
        return $dg->variable($this, $field);
    }

    public function getFilename(string $base): string
    {
        return $base . '.graphql';
    }

    public function getDatatypeNamespace(): string
    {
        return $this->datatypeNamespace;
    }
}
