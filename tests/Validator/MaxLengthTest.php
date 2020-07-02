<?php declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\MaxLength;
use PHPUnit\Framework\TestCase;

class MaxLengthTest extends TestCase
{
    public function testPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        \Formularium\Validator\MaxLength::class => [
                            'value' => 5
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = Validator::class('MaxLength')::validate(
            'asdf',
            $model->getField('someString')->getValidator(MaxLength::class),
            Datatype::factory('string'),
            $model
        );
        $this->assertEquals('asdf', $v);
    }

    public function testFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        \Formularium\Validator\MaxLength::class => [
                            'value' => 5
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = Validator::class('MaxLength')::validate(
            'asdfasdfasdf',
            $model->getField('someString')->getValidator(MaxLength::class),
            Datatype::factory('string'),
            $model
        );
    }
}
