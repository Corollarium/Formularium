<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_usmall extends Datatype_integer
{
    protected $minvalue = 0;
    protected $maxvalue = 65536;

    public function __construct(string $typename = 'usmall', string $basetype = 'integer')
    {
        parent::__construct($typename, $basetype);
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "smallInteger(\"$name\")->unsigned()";
    }

    public function getDocumentation(): string
    {
        return "Datatype for unsigned small integers, between {$this->minvalue} and {$this->maxvalue}.";
    }
}
