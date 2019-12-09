<?php

declare(strict_types=1);

use Formularium\Datatype\Datatype_string;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\Renderable;
use PHPUnit\Framework\TestCase;

final class FieldTest extends TestCase
{
    public function testAccessors()
    {
        $name = 'test string';
        $data = [
            'datatype' => 'string',
            'validators' => [
                Datatype_string::MAX_LENGTH => 30
            ],
            'extensions' => [
                Renderable::PLACEHOLDER => 'blabla'
            ],
        ];
        $field = Field::getFromData($name, $data);
        $this->assertEquals($name, $field->getName());
        $this->assertInstanceOf(Datatype_string::class, $field->getDatatype());
        $this->assertEquals($data['validators'], $field->getValidators());
        $this->assertEquals($data['extensions'], $field->getExtensions());
        $this->assertEquals($data['extensions'][Renderable::PLACEHOLDER], $field->getExtension('placeholder', 'x'));
        $this->assertEquals('xxx', $field->getExtension('lalal', 'xxx'));
    }

    public function testMissingName()
    {
        $this->expectException(Exception::class);
        $field = Field::getFromData('', []);
    }

    public function testMissingDatatype()
    {
        $this->expectException(Exception::class);
        $field = Field::getFromData('asdf', []);
    }

    public function testInvalidDatatype()
    {
        $this->expectException(Exception::class);
        $field = Field::getFromData('asdf', ['datatype' => 'asdfmasdf']);
    }
}
