<?php declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\Filled;
use PHPUnit\Framework\TestCase;

class ValidatorFilledTest extends TestCase
{
    public function testFilled()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        Filled::class => [ 'value' => true],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = Validator::class('Filled')::validate(
            'x',
            $model->getField('someString')->getValidator(Filled::class),
            Datatype::factory('string'),
            $model
        );
        $this->assertEquals('x', $v);
    }

    public function testFilledFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        Filled::class => [ 'value' => true],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v =  Validator::class('Filled')::validate(
            'x',
            $model->getField('someString')->getValidator(Filled::class),
            Datatype::factory('string'),
            $model
        );
        $this->assertEquals('x', $v);
    }
}
