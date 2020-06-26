<?php declare(strict_types=1);

use Formularium\Model;
use Formularium\Validator\RequiredWithAll;
use PHPUnit\Framework\TestCase;

class ValidatorRequiredWithAllTest extends TestCase
{
    public function testRequiredWithAll()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                    ]
                ],
                'someOtherInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                    ]
                ],
                'someString' => [
                    'datatype' => 'string',
                    'validators' => [
                        RequiredWithAll::class => [
                            'fields' => ['someInteger', 'someOtherInteger'],
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $v = $model->validate(['someString' => 'aaaa', 'someInteger' => 10, 'someOtherInteger' => 20]);
        $this->assertEmpty($v['errors']);

        $v = $model->validate(['someInteger' => 10]);
        $this->assertEmpty($v['errors']);
    }

    public function testRequiredWithAllFail()
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
                        RequiredWithAll::class => [
                            'fields' => [ 'someInteger' ],
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);

        $v = $model->validate(['someInteger' => 10, 'someOtherInteger' => 20]);
        $this->assertArrayHasKey('someString', $v['errors']);

        $v = $model->validate(['someString' => '', 'someInteger' => 10, 'someOtherInteger' => 20]);
        $this->assertArrayHasKey('someString', $v['errors']);
    }
}
