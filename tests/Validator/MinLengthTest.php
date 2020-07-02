<?php declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\MinLength;
use PHPUnit\Framework\TestCase;

class MinLengthTest extends TestCase
{
    public function testPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        \Formularium\Validator\MinLength::class => [
                            'value' => 5
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = Validator::class('MinLength')::validate(
            'asdfasdfasdf',
            $model->getField('someString')->getValidator(MinLength::class),
            Datatype::factory('string'),
            $model
        );
        $this->assertEquals('asdfasdfasdf', $v);
    }

    public function testFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        \Formularium\Validator\MinLength::class => [
                            'value' => 5
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = Validator::class('MinLength')::validate(
            'x',
            $model->getField('someString')->getValidator(MinLength::class),
            Datatype::factory('string'),
            $model
        );
    }
}
