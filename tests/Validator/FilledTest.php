<?php declare(strict_types=1);

use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\Filled;
use PHPUnit\Framework\TestCase;

class ValidatorFilledTest extends TestCase
{
    public function testFilled()
    {
        $validator = \Formularium\Validator::factory('Filled');
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        Filled::class => true,
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = $validator->validate('x', $model->getField('someString')->getValidators(), $model);
        $this->assertEquals('x', $v);
    }

    public function testFilledFail()
    {
        $validator = \Formularium\Validator::factory('Filled');
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        Filled::class => true,
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = $validator->validate('x', $model->getField('someString')->getValidators(), $model);
        $this->assertEquals('x', $v);
    }
}
