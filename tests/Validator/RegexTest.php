<?php declare(strict_types=1);

namespace FormulariumTests\Validator;

use Formularium\Model;
use Formularium\Datatype\Regex;
use Formularium\Factory\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Factory\ValidatorFactory;
use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function testFilled()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someField' => [
                    'datatype' => 'string',
                    'validators' => [
                        Regex::class => [
                            'value' => '/^[abcdefABCDEF]+$/'
                        ],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = 'abAc';
        $v = ValidatorFactory::class('Regex')::validate(
            $expected,
            $model->getField('someField')->getValidator(Regex::class),
            $model
        );
        $this->assertEquals($expected, $v);
    }

    public function testFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someField' => [
                    'datatype' => 'string',
                    'validators' => [
                        Regex::class => [
                            'value' => '/^[abcdefABCDEF]+$/'
                        ],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = 'xasdfasdf';
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('Regex')::validate(
            $expected,
            $model->getField('someField')->getValidator(Regex::class),
            $model
        );
    }

    public function testInvalid()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someField' => [
                    'datatype' => 'string',
                    'validators' => [
                        Regex::class => [
                            'value' => '/^[abc' . 'def+$/'
                        ],
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $expected = 'xasdfasdf';
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('Regex')::validate(
            $expected,
            $model->getField('someField')->getValidator(Regex::class),
            $model
        );
    }
}
