<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_countrycode;

class CountryCodeNumericTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('countrycodenumeric');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => '020',
                'expected' => '020',
            ]

        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            [
                'value' => 'BRA',
            ],
            [
                'value' => 'BR',
            ],
        ];
    }
}
