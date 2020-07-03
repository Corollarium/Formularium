<?php declare(strict_types=1);

use Formularium\DatatypeFactory;
use Formularium\Model;
use Formularium\ValidatorFactory;
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
        $v = ValidatorFactory::class('Filled')::validate(
            'x',
            $model->getField('someString')->getValidator(Filled::class),
            DatatypeFactory::factory('string'),
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
        $v =  ValidatorFactory::class('Filled')::validate(
            'x',
            $model->getField('someString')->getValidator(Filled::class),
            DatatypeFactory::factory('string'),
            $model
        );
        $this->assertEquals('x', $v);
    }
}
