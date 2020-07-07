<?php declare(strict_types=1); 

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_email;

class PhoneTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('phone');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        $dt = $this->getDataType();
        return [
            "+551140043134"
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
            323.32,
            null,
            994234023042934923492349
        ];
    }
}
