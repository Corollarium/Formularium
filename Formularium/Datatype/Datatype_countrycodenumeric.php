<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_countrycodenumeric extends \Formularium\Datatype\Datatype_countrycode
{
    public function __construct(string $typename = 'countrycodenumeric', string $basetype = 'enum')
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
        return "char('$name', 3)";
    }

    public function getDocumentation(): string
    {
        return 'Country names represented by ISO numeric codes.';
    }
}
