<?php

namespace Formularium\Datatype;

use Formularium\Field;

abstract class Datatype_number extends \Formularium\Datatype
{
    const MIN = "min";
    const MAX = "max";

    public function __construct($typename = 'number', $basetype = 'number')
    {
        parent::__construct($typename, $basetype);
    }
}
