<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_countrycode;

class DatatypeCountryCodeISO3_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('countrycodeISO3');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => 'BRA',
                'expected' => 'BRA',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            [
                'value' => 'BR',
            ],
            [
                'value' => '033',
            ],
            [
                'value' => 'xxx',
            ]
        ];
    }
}
