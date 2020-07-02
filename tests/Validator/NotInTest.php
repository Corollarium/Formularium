<?php declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\NotIn;
use PHPUnit\Framework\TestCase;

class NotInTest extends TestCase
{
    public function testPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        NotIn::class => [
                            'value' => ["a", "b"]
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = "c";
        $v = Validator::class('NotIn')::validate(
            $expected,
            $model->getField('someString')->getValidatorOption(NotIn::class),
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
                        \Formularium\Validator\NotIn::class => [
                            'value' => ["a", "b"]
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = Validator::class('NotIn')::validate(
            "b",
            $model->getField('someString')->getValidatorOption(NotIn::class),
            Datatype::factory('string'),
            $model
        );
    }
}
