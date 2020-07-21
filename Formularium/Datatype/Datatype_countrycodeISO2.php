<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_countrycodeISO2 extends \Formularium\Datatype\Datatype_countrycode
{
    public function __construct(string $typename = 'countrycodeISO2', string $basetype = 'choice')
    {
        parent::__construct($typename, $basetype);
        $this->setChoices(self::ISO_ALPHA2);
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'CHAR(2)';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "char($name, 2)";
    }
}