<?php

namespace Formularium\Datatype;

class Datatype_uinteger extends \Formularium\Datatype\Datatype_integer
{
    protected $minvalue = 0;
    protected $maxvalue = 4294967296;

    public function __construct($typename = 'uinteger', $basetype = 'integer')
    {
        parent::__construct($typename, $basetype);
    }
}
