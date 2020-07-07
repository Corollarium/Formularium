<?php declare(strict_types=1); 

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class CNPJTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('cnpj');
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
