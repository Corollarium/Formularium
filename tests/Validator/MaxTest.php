<?php declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\Max;
use PHPUnit\Framework\TestCase;

class MaxTest extends TestCase
{
    public function testPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someNumber' => [
                    'datatype' => 'integer',
                    'validators' => [
                        \Formularium\Validator\Max::class => [
                            'value' => 5
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = Validator::class('Max')::validate(
            3,
            $model->getField('someNumber')->getValidator(Max::class),
            Datatype::factory('integer'),
            $model
        );
        $this->assertEquals(3, $v);
    }

    public function testFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someNumber' => [
                    'datatype' => 'string',
                    'validators' => [
                        \Formularium\Validator\Max::class => [
                            'value' => 5
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = Validator::class('Max')::validate(
            30,
            $model->getField('someNumber')->getValidator(Max::class),
            Datatype::factory('integer'),
            $model
        );
    }
}
