<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;

class DatatypeGenerator_languageiso2 extends DatatypeGenerator_string
{
    protected string $basetype = 'CHAR';
}
