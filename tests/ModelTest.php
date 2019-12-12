<?php declare(strict_types=1); 

declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Datatype\Datatype_integer;
use Formularium\Exception\Exception;
use Formularium\Model;
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
   
    public function testFromJSON()
    {
        $json = <<<'EOF'
{ 
    "name": "ModelTest", 
    "fields": {
        "name": {
            "datatype": "string",
            "label": {
                "en": "Name",
                "pt": "Nome"
            },
            "extensions": {
                "comment": {
                    "en": "Your full name",
                    "pt": "Seu nome completo"
                }
            },
            "validator": {
                "required": true,
                "minlength": 30,
                "maxlength": 40
            }
        }
    } 
}
EOF;
        $m = Model::fromJSON($json);
        $this->assertEquals('ModelTest', $m->getName());
        $this->assertIsArray($m->getFields());
    }

    public function testValidate()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                        Datatype_integer::MIN => 4,
                        Datatype_integer::MAX => 30,
                        Datatype::REQUIRED => true,
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
}
