<?php declare(strict_types=1);

namespace FormulariumTests\Validator;

use Formularium\Model;
use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\ValidatorFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Datatype\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testFilled()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someField' => [
                    'datatype' => 'string',
                    'validators' => [
                        Password::class => [
                        ],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = 'xAkdsf8i2345sjsdf';
        $v = ValidatorFactory::class('Password')::validate(
            $expected,
            $model->getField('someField')->getValidator(Password::class),
            $model
        );
        $this->assertEquals($expected, $v);
    }

    public function testFailShort()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someField' => [
                    'datatype' => 'string',
                    'validators' => [
                        Password::class => [
                        ],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = 'x';
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('Password')::validate(
            $expected,
            $model->getField('someField')->getValidator(Password::class),
            $model
        );
    }

    public function testFailEntropy()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someField' => [
                    'datatype' => 'string',
                    'validators' => [
                        Password::class => [
                        ],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = 'aaaaaaa';
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('Password')::validate(
            $expected,
            $model->getField('someField')->getValidator(Password::class),
            $model
        );
    }
}
