<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent;

use Formularium\Model;

class CodeGenerator extends \Formularium\CodeGenerator\CodeGenerator
{
    public function __construct(string $name = 'LaravelEloquent')
    {
        parent::__construct($name);
    }

    public function type(Model $model): string
    {
        $indices = '';
        return implode(
            ";\n",
            array_map(
                function ($f) {
                    return '$table->' . $f;
                },
                $this->fields($model)
            )
        );
    }

    public function getFilename(string $base): string
    {
        return $base . '.php';
    }
}
