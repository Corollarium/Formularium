<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class DatatypeCPF_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('cpf');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            '468.574.325-38',
            '46857432538',
            ''
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            '468.574.325-33',
            'asdfasdf'
        ];
    }
}
