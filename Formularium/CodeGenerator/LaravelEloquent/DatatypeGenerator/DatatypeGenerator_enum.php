<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

class DatatypeGenerator_enum extends DatatypeGenerator_string
{
    protected function maxLength(): int
    {
        return 32;
    }
}
