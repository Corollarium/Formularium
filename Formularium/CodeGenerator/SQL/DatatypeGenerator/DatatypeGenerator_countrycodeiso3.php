<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

class DatatypeGenerator_countrycodeiso3 extends DatatypeGenerator_enum
{
    /**
     * @var string
     */
    protected $basetype = 'CHAR';

    protected function maxLength(): int
    {
        return 3;
    }
}
