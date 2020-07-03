<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_string;

class DatatypeText_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType($framework = ''): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('text', $framework);
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            'aaaa',
            "asdkf asdfadsf",
            "asdfçéŕ",
            ""
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            null
        ];
    }
}
