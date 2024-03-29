<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_countrycodeiso2 extends \Formularium\Datatype\Datatype_countrycode
{
    public function __construct(string $typename = 'countrycodeiso2', string $basetype = 'enum')
    {
        parent::__construct($typename, $basetype);
        $this->setChoices(self::ISO_ALPHA2);
    }
    
    public function getDocumentation(): string
    {
        return 'Country names represented by ISO 2-letter codes.';
    }
}
