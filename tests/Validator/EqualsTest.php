<?php declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\Equals;
use PHPUnit\Framework\TestCase;

class EqualsTest extends TestCase
{
    public function testPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        Equals::class => [
                            'value' => "b"
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = "b";
        $v = Validator::class('Equals')::validate(
            $expected,
            $model->getField('someString')->getValidator(Equals::class),
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
                        \Formularium\Validator\Equals::class => [
                            'value' => "b"
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = Validator::class('Equals')::validate(
            "c",
            $model->getField('someString')->getValidator(Equals::class),
            Datatype::factory('string'),
            $model
        );
    }
}
