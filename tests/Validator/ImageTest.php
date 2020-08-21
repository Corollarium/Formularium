<?php declare(strict_types=1);

use Formularium\Factory\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Factory\ValidatorFactory;
use Formularium\Validator\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testWidthPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        Image::class => [
                            Image::DIMENSION_WIDTH => 400
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $file = __DIR__ . "/../files/logo-horizontal-400px.png";
        $v = ValidatorFactory::class('Image')::validate(
            $file,
            $model->getField('someFile')->getValidator(Image::class),
            $model
        );
        $this->assertEquals($file, $v);
    }

    public function testWidthFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        Image::class => [
                            Image::DIMENSION_WIDTH => 200
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $file = __DIR__ . "/../files/logo-horizontal-400px.png";
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('Image')::validate(
            $file,
            $model->getField('someFile')->getValidator(Image::class),
            $model
        );
    }

    public function testHeightPass()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        Image::class => [
                            Image::DIMENSION_HEIGHT => 139
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $file = __DIR__ . "/../files/logo-horizontal-400px.png";
        $v = ValidatorFactory::class('Image')::validate(
            $file,
            $model->getField('someFile')->getValidator(Image::class),
            $model
        );
        $this->assertEquals($file, $v);
    }

    public function testHeightFail()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someFile' => [
                    'datatype' => 'file',
                    'validators' => [
                        Image::class => [
                            Image::DIMENSION_HEIGHT => 200
                        ]
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);
        $file = __DIR__ . "/../files/logo-horizontal-400px.png";
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('Image')::validate(
            $file,
            $model->getField('someFile')->getValidator(Image::class),
            $model
        );
    }
}
