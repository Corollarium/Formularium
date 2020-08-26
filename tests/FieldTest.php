<?php declare(strict_types=1);

namespace FormulariumTests;

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
                MaxLength::class => [
                    'value' => 30
                ]
            ],
            'renderable' => [
                Renderable::PLACEHOLDER => 'blabla'
            ],
            'extradata' => [
                [
                    'name' => 'someitem',
                    'args' => [
                        ['name' => 'someparameter', 'value' => 'somevalue' ]
                    ]
                ]
            ]
        ];
        $field = Field::getFromData($name, $data);
        $this->assertEquals($name, $field->getName());
        $this->assertInstanceOf(Datatype_string::class, $field->getDatatype());
        $this->assertEquals($data['validators'], $field->getValidators());
        $this->assertEquals($data['renderable'], $field->getRenderables());
        $this->assertEquals($data['renderable'][Renderable::PLACEHOLDER], $field->getRenderable('placeholder', 'x'));
        $this->assertEquals('xxx', $field->getRenderable('lalal', 'xxx'));
        
        $this->assertEquals('somevalue', $field->getExtradataValue('someitem', 'someparameter'));
        $this->assertEquals('xxx', $field->getExtradataValue('someasdf', 'somevasfd', 'xxx'));
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
