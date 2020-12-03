<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\Exception;

class Datatype_timezone extends \Formularium\Datatype\Datatype_enum
{
    public function __construct(string $typename = 'timezone', string $basetype = 'enum')
    {
        parent::__construct($typename, $basetype);
        $l = timezone_identifiers_list();
        $this->choices = (array)array_combine($l, $l);
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'VARCHAR(50)';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "string($name, 50)";
    }

    public function getDocumentation(): string
    {
        return "Timezones. Follows PHP timezone_identifiers_list().";
    }
}
