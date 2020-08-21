<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class UUIDTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Factory\DatatypeFactory::factory('uuid');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        $dt = $this->getDataType();
        return [
            'af440a2c-a871-4d1c-b6f5-407da1b83cb4'
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        $dt = $this->getDataType();
        return [
            'a',
            'bisfowsero',
            323.32,
            -303,
            null,
            994234023042934923492349,
            'af440a2c-a871-4d1c-b6f5-407da1b83cb43',
            'af440a2c-a871-5d1c-b6f5-407da1b83cb4'
        ];
    }
}
