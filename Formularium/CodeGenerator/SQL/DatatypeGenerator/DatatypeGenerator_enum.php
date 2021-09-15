<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\SQL\SQLDatatypeGenerator;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;
use Formularium\Datatype;
use Formularium\Datatype\Datatype_string;
use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\DatatypeGeneratorFactory;

/**
 * Enums are not a good idea for DBs. This is an opinionated version using strings.
 * You can of course override this in your own type and implement an actual `enum`
 */
class DatatypeGenerator_enum extends DatatypeGenerator_string
{
}
