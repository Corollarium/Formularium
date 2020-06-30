<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_countrycode;

class DatatypeCountryCodeNumeric_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('countrycodeNumeric');
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
