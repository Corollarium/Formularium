<?php declare(strict_types=1); 

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class DatatypeBool_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('bool');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        $dt = $this->getDataType();
        return [
            true,
            false,
            [
                'value' => 'true',
                'expected' => true
            ],
            [
                'value' => 'false',
                'expected' => false
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
            323.32,
            null,
            994234023042934923492349
        ];
    }
}
