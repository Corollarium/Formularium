<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_year extends \Formularium\Datatype\Datatype_integer
{
    public function __construct(string $typename = 'year', string $basetype = 'integer')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $c = (int)date('Y');
        $min = $params[static::MIN]['value'] ?? $c - 30;
        $max = $params[static::MAX]['value'] ?? $c;
        return mt_rand($min, $max);
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "year('$name')";
    }

    public function getDocumentation(): string
    {
        return 'Valid years. May create a special field in the database.';
    }
}
