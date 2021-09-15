<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\SQL\SQLDatatypeGenerator;

class DatatypeGenerator_countrycodenumeric extends DatatypeGenerator_enum
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
