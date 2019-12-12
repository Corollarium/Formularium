<?php declare(strict_types=1); 

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;
use Formularium\Datatype\Datatype_countrycode;

class DatatypeCountryCode_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('countrycode');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => 'BR',
                'expected' => 'BR',
                'validators' => [Datatype_countrycode::CODE_TYPE => Datatype_countrycode::ISO_ALPHA2]
            ],
            [
                'value' => 'BRA',
                'expected' => 'BRA',
                'validators' => [Datatype_countrycode::CODE_TYPE => Datatype_countrycode::ISO_ALPHA3]
            ],
            [
                'value' => '020',
                'expected' => '020',
                'validators' => [Datatype_countrycode::CODE_TYPE => Datatype_countrycode::ISO_NUMERIC]
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
                'validators' => [Datatype_countrycode::CODE_TYPE => Datatype_countrycode::ISO_ALPHA2]
            ],
            [
                'value' => 'BR',
                'validators' => [Datatype_countrycode::CODE_TYPE => Datatype_countrycode::ISO_ALPHA3]
            ],
            [
                'value' => 'xxx',
                'validators' => [Datatype_countrycode::CODE_TYPE => Datatype_countrycode::ISO_NUMERIC]
            ]
        ];
    }
}
