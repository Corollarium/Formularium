<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_year extends \Formularium\Datatype\Datatype_integer
{
    public function __construct(string $typename = 'year', string $basetype = 'integer')
    {
        parent::__construct($typename, $basetype);
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'INT';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "year('$name')";
    }
}
