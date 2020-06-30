<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

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
            null
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
                        \Formularium\Validator\SameAs::class => [
                            "target" => 'field2'
                        ]
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
