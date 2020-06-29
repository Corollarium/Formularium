<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class DatatypeTime_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('time');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            '12:30:45',
            '09:20',
            '16:40',
            ''
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            '26:30:10',
            'asdfa',
            '2012-25-01',
            '2001-00-00'
        ];
    }
}
