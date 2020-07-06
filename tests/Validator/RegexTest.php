<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Model;
use Formularium\Datatype\Regex;
use Formularium\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\ValidatorFactory;
use PHPUnit\Framework\TestCase;

class Regex_TestCase extends TestCase
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
        $expected = 'abAc'; // REPLACE THIS
        $v = ValidatorFactory::class('Regex')::validate(
            $expected,
            $model->getField('someField')->getValidator(Regex::class),
            DatatypeFactory::factory('string'),
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
        $expected = 'xasdfasdf'; // REPLACE THIS
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('Regex')::validate(
            $expected,
            $model->getField('someField')->getValidator(Regex::class),
            DatatypeFactory::factory('string'),
            $model
        );
    }
}
