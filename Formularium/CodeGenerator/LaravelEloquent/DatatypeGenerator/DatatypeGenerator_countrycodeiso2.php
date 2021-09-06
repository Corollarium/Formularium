<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

class DatatypeGenerator_countrycodeiso2 extends DatatypeGenerator_string
{
    /**
     * @var string
     */
    protected $basetype = 'char';

    protected function maxLength(): int
    {
        return 2;
    }
}
