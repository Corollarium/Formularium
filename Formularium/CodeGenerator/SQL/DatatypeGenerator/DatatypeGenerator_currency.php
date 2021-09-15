<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;

class DatatypeGenerator_currency extends DatatypeGenerator_enum
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
