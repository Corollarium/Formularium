<?php

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class DatatypeFloat_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('float');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        $dt = $this->getDataType();
        return [
            1.0,
            3.141592,
            [
                'value' => '1.2',
                'expected' => 1.2
            ]
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        $dt = $this->getDataType();
        return [
            'aasdfasdf',
            'bisfowsero',
            null
        ];
    }
}
