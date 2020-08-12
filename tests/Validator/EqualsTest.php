<?php declare(strict_types=1);

use Formularium\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorFactory;
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
        $v = ValidatorFactory::class('Equals')::validate(
            $expected,
            $model->getField('someString')->getValidator(Equals::class),
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
        $v = ValidatorFactory::class('Equals')::validate(
            "c",
            $model->getField('someString')->getValidator(Equals::class),
            $model
        );
    }
}
