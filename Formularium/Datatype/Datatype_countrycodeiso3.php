<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_countrycodeiso3 extends \Formularium\Datatype\Datatype_countrycode
{
    public function __construct(string $typename = 'countrycodeiso3', string $basetype = 'enum')
    {
        parent::__construct($typename, $basetype);
        $this->setChoices(self::ISO_ALPHA3);
    }
    
    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "char('$name', 3)";
    }

    public function getDocumentation(): string
    {
        return 'Country names represented by ISO 3-letter codes.';
    }
}
