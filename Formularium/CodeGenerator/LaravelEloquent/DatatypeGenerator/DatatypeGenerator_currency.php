<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\LaravelEloquent\CodeGenerator as LaravelEloquentCodeGenerator;

class DatatypeGenerator_currency extends DatatypeGenerator_enum
{
    /**
     * @var string
     */
    protected $basetype = 'char';

    protected function maxLength(): int
    {
        return 3;
    }
}
