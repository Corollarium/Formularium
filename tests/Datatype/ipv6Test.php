<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class ipv6Test extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('ipv6');
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
                'value' => 'afgksdf',
                // optional: 'validators' => []
            ]
        ];
    }
}
