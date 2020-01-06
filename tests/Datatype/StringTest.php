<?php declare(strict_types=1);

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;
use Formularium\Datatype\Datatype_string;
use Formularium\Model;

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

    private function _getModel()
    {
        $model = Model::fromStruct([
            "name" =>  "ModelTest",
            "fields" => [
                "field1" => [
                    "datatype" => "string",
                    "validators" => [
                        Datatype_string::SAME_AS => 'field2'
                    ]
                ],
                "field2" => [
                    "datatype" => "string",
                ]
            ]
        ]);
        return $model;
    }
    
    public function testSameAs()
    {
        $model = $this->_getModel();
        $v = $model->validate(['field1' => 'aaa', 'field2' => 'aaa']);
        $this->assertEmpty($v['errors']);
    }

    public function testSameAsFail()
    {
        $model = $this->_getModel();
        $v = $model->validate(['field1' => 'aaa', 'field2' => 'bb']);
        $this->assertNotEmpty($v['errors']);
    }
}
