<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_countrycode;

class DatatypeCurrency_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('currency');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => 'USD',
                'expected' => 'USD',
            ],
            [
                'value' => 'BRL',
                'expected' => 'BRL'
            ],
            [
                'value' => '',
                'expected' => ''
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
                'value' => 'NXN'
            ],
        ];
    }
}
