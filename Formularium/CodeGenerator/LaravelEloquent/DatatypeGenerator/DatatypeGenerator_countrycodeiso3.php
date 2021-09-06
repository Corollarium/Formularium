<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

class DatatypeGenerator_countrycodeiso3 extends DatatypeGenerator_string
{
    protected string $basetype = 'char';

    protected function maxLength(): int
    {
        return 3;
    }
}
