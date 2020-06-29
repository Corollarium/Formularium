<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class Datatypeipv4_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('ipv4');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => '1.1.1.1',
                'expected' => '1.1.1.1'
                // optional: 'validators' => []
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
                'value' => '234.484.234.102',
            ]
        ];
    }
}
