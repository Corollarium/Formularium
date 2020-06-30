<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_countrycodeNumeric extends \Formularium\Datatype\Datatype_countrycode
{
    public function __construct(string $typename = 'countrycodeNumeric', string $basetype = 'choice')
    {
        parent::__construct($typename, $basetype);
        $this->setChoices(self::ISO_NUMERIC);
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'CHAR(3)';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "char($name, 3)";
    }
}
