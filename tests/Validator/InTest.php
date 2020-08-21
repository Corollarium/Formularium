<?php declare(strict_types=1);

use Formularium\Factory\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Factory\ValidatorFactory;
use Formularium\Validator\In;
use PHPUnit\Framework\TestCase;

class InTest extends TestCase
{
    public function testPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        In::class => [
                            'value' => ["a", "b"]
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = "b";
        $v = ValidatorFactory::class('In')::validate(
            $expected,
            $model->getField('someString')->getValidator(In::class),
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
                        \Formularium\Validator\In::class => [
                            'value' => ["a", "b"]
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('In')::validate(
            "c",
            $model->getField('someString')->getValidator(In::class),
            $model
        );
    }
}
