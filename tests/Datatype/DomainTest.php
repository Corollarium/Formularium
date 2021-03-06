<?php declare(strict_types=1); 

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class DomainTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Factory\DatatypeFactory::factory('domain');
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
