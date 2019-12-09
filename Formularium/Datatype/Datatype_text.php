<?php

namespace Formularium\Datatype;

class Datatype_text extends Datatype_string
{
    protected $MAX_STRING_SIZE = 1024000;

    public function __construct($typename = 'text', $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return static::faker()->text(); // TODO: params
    }
}
