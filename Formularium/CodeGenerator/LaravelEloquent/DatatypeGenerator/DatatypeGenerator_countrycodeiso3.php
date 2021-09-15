<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

class DatatypeGenerator_countrycodeiso3 extends DatatypeGenerator_enum
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
