<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_integer;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\Model;
use Formularium\Validator\Max;
use Formularium\Validator\Min;
use PHPUnit\Framework\TestCase;

final class ModelTest extends TestCase
{
    public function testFromJSONInvalid()
    {
        $this->expectException(Exception::class);
        $json = 'sdfla{sdf';
        Model::fromJSON($json);
    }

    public function testFromJSONMissingName()
    {
        $this->expectException(Exception::class);
        $json = '{}';
        Model::fromJSON($json);
    }

    public function testFromJSONMissingFields()
    {
        $this->expectException(Exception::class);
        $json = '{"name": "Xyz"}';
        Model::fromJSON($json);
    }

    public function testFromJSONInvalidDatatype()
    {
        $this->expectException(Exception::class);
        $json = <<<'EOF'
{ 
    "name": "ModelTest", 
    "fields": {
        "name": {
            "datatype": "bvksdvbmxcvbm"
        }
    } 
}
EOF;
        Model::fromJSON($json);
    }
   
    public function testJSON()
    {
        $json = <<<'EOF'
{ 
    "name": "ModelTest", 
    "fields": {
        "name": {
            "datatype": "string",
            "validators": {
                "required": {
                    "value": true
                },
                "minlength": {
                    "value": 30
                },
                "maxlength": {
                    "value": 40
                }
            },
            "renderable": {
                "comment": {
                    "en": "Your full name",
                    "pt": "Seu nome completo"
                }
            }
        }
    } 
}
EOF;
        $m = Model::fromJSON($json);
        $this->assertEquals('ModelTest', $m->getName());
        $this->assertIsArray($m->getFields());
        $this->assertJsonStringEqualsJsonString($json, $m->toJSON());
    }

    public function testValidate()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                        Min::class => [
                            'value' => 4
                        ],
                        Max::class => [
                            'value' => 30
                        ],
                        Datatype::REQUIRED => [
                            'value' => true
                        ],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);

        // required
        $v = $model->validate([]);
        $this->assertArrayHasKey('someInteger', $v['errors']);

        // min
        $v = $model->validate(['someInteger' => 1]);
        $this->assertArrayHasKey('someInteger', $v['errors']);

        // ok
        $v = $model->validate(['someInteger' => 6]);
        $this->assertEmpty($v['errors']);
    }

    public function testValidator()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        \Formularium\Validator\Filled::class => ['value' => true],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);

        // filled
        $v = $model->validate(['someString' => '']);
        $this->assertArrayHasKey('someString', $v['errors']);

        // ok
        $v = $model->validate(['someString' => 'aa']);
        $this->assertEmpty($v['errors']);
    }

    public function testRandom()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                        Min::class => [
                            'value' => 4,
                        ],
                        Max::class => [
                            'value' => 30,
                        ],
                        Datatype::REQUIRED => [
                            'value' => true,
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);

        // required
        $r = $model->getRandom();
        $this->assertArrayHasKey('someInteger', $r);
    }

    public function testFilterField()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                        Min::class => [
                            'value' => 4,
                        ],
                        Max::class => [
                            'value' => 30,
                        ],
                        Datatype::REQUIRED => [
                            'value' => true,
                        ]
                    ]
                ],
                'someOther' => [
                    'datatype' => 'integer',
                    'validators' => [
                        Min::class => [
                            'value' => 4,
                        ],
                        Max::class => [
                            'value' => 30,
                        ],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);

        // required
        $r = $model->filterField(
            function (Field $field) {
                return $field->getValidator(Datatype::REQUIRED, false);
            }
        );
        $this->assertEquals(1, count($r));
        $this->assertArrayHasKey('someInteger', $r);
        $this->assertEquals('someInteger', $r['someInteger']->getName());
    }
}
