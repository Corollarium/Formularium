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

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'SMALLINT UNSIGNED';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "smallInteger($name)->unsigned()";
    }
}
