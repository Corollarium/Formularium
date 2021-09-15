<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

class DatatypeGenerator_language extends DatatypeGenerator_enum
{
    /**
     * @var string
     */
    protected $basetype = 'CHAR';

    protected function maxLength(): int
    {
        return 10;
    }
}
