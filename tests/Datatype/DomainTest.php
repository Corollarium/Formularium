<?php

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class DatatypeDomain_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('domain');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        $dt = $this->getDataType();
        return [
            'corollarium.com',
            'corollarium.net',
            'some.sub.corollarium.com',
            'test.asia',
            'corollarium.com.br',
            ''
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
