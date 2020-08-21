<?php declare(strict_types=1);

use Formularium\Factory\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Factory\ValidatorFactory;
use Formularium\Validator\Min;
use PHPUnit\Framework\TestCase;

class MinTest extends TestCase
{
    public function testPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someNumber' => [
                    'datatype' => 'integer',
                    'validators' => [
                        \Formularium\Validator\Min::class => [
                            'value' => 5
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = ValidatorFactory::class('Min')::validate(
            6,
            $model->getField('someNumber')->getValidator(Min::class),
            $model
        );
        $this->assertEquals(6, $v);
    }

    public function testFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someNumber' => [
                    'datatype' => 'string',
                    'validators' => [
                        \Formularium\Validator\Min::class => [
                            'value' => 5
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('Min')::validate(
            3,
            $model->getField('someNumber')->getValidator(Min::class),
            $model
        );
    }
}
