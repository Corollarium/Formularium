<?php declare(strict_types=1);

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class Datatypeipv6_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('ipv6');
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