<?php declare(strict_types=1); 

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_email;

class EmailTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Factory\DatatypeFactory::factory('email');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        $dt = $this->getDataType();
        return [
            "someemail@corollarium.com",
            "someemail@corollarium.com.br",
            "someone@fancy.camera",
            "lzsomejagrentalservices702@gmail.com"
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
