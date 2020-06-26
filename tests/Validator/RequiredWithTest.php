<?php declare(strict_types=1);

use Formularium\Model;
use Formularium\Validator\RequiredWith;
use PHPUnit\Framework\TestCase;

class ValidatorRequiredWithTest extends TestCase
{
    public function testRequiredWith()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                    ]
                ],
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        RequiredWith::class => [
                            'fields' => ['someInteger'],
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = $model->validate(['someString' => 'aaaa', 'someInteger' => 10]);
        $this->assertEmpty($v['errors']);

        $v = $model->validate([]);
        $this->assertEmpty($v['errors']);
    }

    public function testRequiredWithFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                    ]
                ],
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        RequiredWith::class => [
                            'fields' => [ 'someInteger' ],
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);

        $v = $model->validate(['someInteger' => 10]);
        $this->assertArrayHasKey('someString', $v['errors']);

        $v = $model->validate(['someString' => '', 'someInteger' => 10]);
        $this->assertArrayHasKey('someString', $v['errors']);
    }
}
