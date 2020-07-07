<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class TimezoneTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('timezone');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => 'America/Sao_Paulo',
                'expected' => 'America/Sao_Paulo',
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
                'value' => 'asdf asdf',
            ]
        ];
    }
}
