<?php declare(strict_types=1);

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class DatatypeTimezone_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('timezone');
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
