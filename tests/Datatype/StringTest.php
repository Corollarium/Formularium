<?php

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;
use Formularium\Datatype\Datatype_string;

class DatatypeString_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType($framework = ''): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('string', $framework);
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
            [
                'value' => 'aaa',
                'validators' => [
                    Datatype_string::MIN_LENGTH => 5
                ]
            ],
            [
                'value' => 'aaaaaaaaaaaaaaaaaa',
                'validators' => [
                    Datatype_string::MAX_LENGTH => 5
                ]
            ]
        ];
    }
}
