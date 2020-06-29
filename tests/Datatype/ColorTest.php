<?php declare(strict_types=1); 

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_email;

class DatatypeColor_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('color');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        $dt = $this->getDataType();
        return [
            "#000000",
            "#ffffff",
            "#abcdef",
            '#FFFFFF'
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        $dt = $this->getDataType();
        return [
            '#12345',
            '#abcdefg',
            '#abcdeg',
            'aasdfasdf',
            'bisfowsero',
            323.32,
            null,
            994234023042934923492349
        ];
    }
}
