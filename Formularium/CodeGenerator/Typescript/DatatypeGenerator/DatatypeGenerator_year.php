<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript\DatatypeGenerator;

use Formularium\CodeGenerator\Typescript\TypescriptDatatypeGenerator;

class DatatypeGenerator_year extends TypescriptDatatypeGenerator
{
    public function getBasetype(): string
    {
        return 'number';
    }
}
