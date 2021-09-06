<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_timestamp extends Datatype_datetime
{
    public function __construct(string $typename = 'timestamp', string $basetype = 'datetime')
    {
        parent::__construct($typename, $basetype);
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "timestamp('$name')";
    }

    public function getDocumentation(): string
    {
        return "Timestamps. Just like datetime, but might be a different type in your database.";
    }
}
