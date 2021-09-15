<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\LaravelEloquent\DatatypeGenerator;

class DatatypeGenerator_language extends DatatypeGenerator_enum
{
    /**
     * @var string
     */
    protected $basetype = 'char';

    protected function maxLength(): int
    {
        return 12;
    }
}
