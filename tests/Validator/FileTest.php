<?php declare(strict_types=1);

use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Factory\ValidatorFactory;
use Formularium\Validator\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testNotAFile()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        File::class => [
                            File::MAX_SIZE => 1024
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('File')::validate(
            __DIR__ . "/files/xxx.png",
            $model->getField('someFile')->getValidator(File::class),
            $model
        );
    }

    public function testMaxSizeFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        File::class => [
                            File::MAX_SIZE => 1024
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('File')::validate(
            __DIR__ . "/../files/logo-horizontal-400px.png",
            $model->getField('someFile')->getValidator(File::class),
            $model
        );
    }

    public function testMaxSizePass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        File::class => [
                            File::MAX_SIZE => 102400000
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $file = __DIR__ . "/../files/logo-horizontal-400px.png";
        $v = ValidatorFactory::class('File')::validate(
            $file,
            $model->getField('someFile')->getValidator(File::class),
            $model
        );
        $this->assertEquals($file, $v);
    }

    public function testAcceptImage()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        File::class => [
                            File::ACCEPT => File::ACCEPT_IMAGE
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $file = __DIR__ . "/../files/logo-horizontal-400px.png";
        $v = ValidatorFactory::class('File')::validate(
            $file,
            $model->getField('someFile')->getValidator(File::class),
            $model
        );
        $this->assertEquals($file, $v);
    }

    public function testAcceptFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        File::class => [
                            File::ACCEPT => File::ACCEPT_AUDIO
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('File')::validate(
            __DIR__ . "/../files/logo-horizontal-400px.png",
            $model->getField('someFile')->getValidator(File::class),
            $model
        );
    }
}
