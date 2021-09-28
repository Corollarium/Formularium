<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript;

use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\Factory\DatatypeGeneratorFactory;
use Formularium\Model;

class CodeGenerator extends \Formularium\CodeGenerator\CodeGenerator
{
    const TAB = '  ';

    /**
     * Prefixes datatypes with a namespace
     *
     * @var string
     */
    public $datatypeNamespace = '';

    public function __construct(string $name = 'Typescript')
    {
        parent::__construct($name);
    }

    public function type(Model $model): string
    {
        $fields = implode("\n", $this->fields($model));
        return <<<EOD
export interface {$model->getName()} {
$fields
}
EOD;
    }

    public function getFilename(string $base): string
    {
        return $base . '.ts';
    }

    public function fieldDeclaration(string $datatype, string $name): string
    {
        return self::TAB . $name . ': ' . $datatype . ';';
    }

    public function getDatatypeNamespace(): string
    {
        return $this->datatypeNamespace;
    }
}
