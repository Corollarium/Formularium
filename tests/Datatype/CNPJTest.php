<?php

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class DatatypeCNPJ_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('cnpj');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            '00.000.000/0001-91',
            '00000000000191',
            ''
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            '00.000.000/0001-92',
            'asdfasdf'
        ];
    }
}