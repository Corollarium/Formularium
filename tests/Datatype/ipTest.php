<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class Datatypeip_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('ip');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => '2001:0db8:85a3:0000:0000:8a2e:0370:7334',
                'expected' => '2001:0db8:85a3:0000:0000:8a2e:0370:7334',
            ],
            [
                'value' => '1.1.1.1',
                'expected' => '1.1.1.1'
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
                'value' => 'xcvxcv',
            ]
        ];
    }
}
