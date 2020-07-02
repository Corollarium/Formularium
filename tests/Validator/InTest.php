<?php declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\In;
use PHPUnit\Framework\TestCase;

class InTest extends TestCase
{
    public function testPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        In::class => [
                            'value' => ["a", "b"]
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = "b";
        $v = Validator::class('In')::validate(
            $expected,
            $model->getField('someString')->getValidatorOption(In::class),
            Datatype::factory('string'),
            $model
        );
        $this->assertEquals($expected, $v);
    }

    public function testFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        \Formularium\Validator\In::class => [
                            'value' => ["a", "b"]
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = Validator::class('In')::validate(
            "c",
            $model->getField('someString')->getValidatorOption(In::class),
            Datatype::factory('string'),
            $model
        );
    }
}
