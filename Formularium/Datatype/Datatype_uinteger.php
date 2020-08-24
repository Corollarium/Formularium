<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_uinteger extends \Formularium\Datatype\Datatype_integer
{
    protected $minvalue = 0;
    protected $maxvalue = 4294967296;

    public function __construct(string $typename = 'uinteger', string $basetype = 'integer')
    {
        parent::__construct($typename, $basetype);
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'INT UNSIGNED';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "integer(\"$name\")->unsigned()";
    }

    public function getDocumentation(): string
    {
        return "Datatype for unsigned integers, between {$this->minvalue} and {$this->maxvalue}.";
    }
}
