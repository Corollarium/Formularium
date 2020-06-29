<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_integer;

class DatatypeUInteger_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('uinteger');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        /**
         * @var Datatype_uinteger $dt
         */
        $dt = $this->getDataType();
        return [3, 2340, '2340', 402304, 0, $dt->getMinValue(), $dt->getMaxValue(), ''];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        /**
         * @var Datatype_uinteger $dt
         */
        $dt = $this->getDataType();
        return [
            'a',
            'bisfowsero',
            323.32,
            null,
            -3234,
            994234023042934923492349,
            $dt->getMinValue()-1,
            $dt->getMaxValue()+1,
            [
                'value' => 300,
                'validators' => [
                    Datatype_integer::MAX => [
                        'value' => 100
                    ]
                ]
            ],
            [
                'value' => 30,
                'validators' => [
                    Datatype_integer::MIN => [
                        'value' => 100
                    ]
                ]
            ],
        ];
    }
}
