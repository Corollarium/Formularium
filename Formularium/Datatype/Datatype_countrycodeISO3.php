<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_countrycodeISO3 extends \Formularium\Datatype\Datatype_countrycode
{
    public function __construct(string $typename = 'countrycodeISO3', string $basetype = 'choice')
    {
        parent::__construct($typename, $basetype);
        $this->setChoices(self::ISO_ALPHA3);
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
