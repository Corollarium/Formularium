<?php declare(strict_types=1); 

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_email;

class URLTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Factory\DatatypeFactory::factory('url');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        $dt = $this->getDataType();
        return [
            "https://corollarium.com",
            "http://corollarium.com/",
            "http://corollarium.com/product",
            "HTTPS://COROLLARIUM.COM",
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
            'asdf://asdfkasdf.com',
            'asdfasdçzxc',
            323.32,
            null,
            994234023042934923492349
        ];
    }
}
