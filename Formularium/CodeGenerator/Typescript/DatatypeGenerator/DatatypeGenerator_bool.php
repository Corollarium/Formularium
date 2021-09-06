<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\Typescript\DatatypeGenerator;

use Formularium\CodeGenerator\Typescript\TypescriptDatatypeGenerator;

class DatatypeGenerator_bool extends TypescriptDatatypeGenerator
{
    protected function getDatatypeBasename(): string
    {
        return 'boolean';
    }
    
    public function getBasetype(): string
    {
        return 'boolean';
    }
}
