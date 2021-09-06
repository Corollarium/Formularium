<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript\DatatypeGenerator;

use Formularium\CodeGenerator\Typescript\TypescriptDatatypeGenerator;

class DatatypeGenerator_usmall extends TypescriptDatatypeGenerator
{
    public function getBasetype(): string
    {
        return 'number';
    }
}
