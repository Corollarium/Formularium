<?php

namespace Formularium\Datatype;

class Datatype_usmall extends Datatype_integer
{
    protected $minvalue = 0;
    protected $maxvalue = 65536;

    public function __construct($typename = 'usmall', $basetype = 'integer')
    {
        parent::__construct($typename, $basetype);
    }
}
