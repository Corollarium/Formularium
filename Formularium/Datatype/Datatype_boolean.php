<?php declare(strict_types=1);

namespace Formularium\Datatype;

/**
 * alias for Datatype_bool.
 */
class Datatype_boolean extends \Formularium\Datatype\Datatype_bool
{
    public function __construct(string $typename = 'boolean', string $basetype = 'bool')
    {
        parent::__construct($typename, $basetype);
    }
}
