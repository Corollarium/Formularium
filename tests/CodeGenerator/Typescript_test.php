<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Frontend\HTML\Renderable;
use Formularium\Model;
use Formularium\CodeGenerator\Typescript\CodeGenerator as TypescriptCodeGenerator;
use PHPUnit\Framework\TestCase;

final class TypescriptTest extends TestCase
{
    public function testBase()
    {
        /*
         * basic demo fiels
         */
        $basicFields = [
            'myAlpha' => [
                'datatype' => 'alpha',
                'validators' => [
                ],
                'renderable' => [
                    Renderable::LABEL => 'Name',
                    Renderable::SCHEMA_ITEMPROP => 'name',
                ],
            ],
            'myBool' => [
                'datatype' => 'bool',
                'validators' => [
                ],
                'renderable' => [
                    Renderable::LABEL => 'Name',
                    Renderable::SCHEMA_ITEMPROP => 'name',
                ],
            ],
            'myBoolean' => [
                'datatype' => 'boolean',
                'validators' => [
                ],
                'renderable' => [
                    Renderable::LABEL => 'Name',
                    Renderable::SCHEMA_ITEMPROP => 'name',
                ],
            ],
            'myInt' => [
                'datatype' => 'integer',
                'validators' => [
                ],
                'renderable' => [
                    Renderable::LABEL => 'Name',
                    Renderable::SCHEMA_ITEMPROP => 'name',
                ],
            ],
            'myDescriptionString' => [
                'datatype' => 'string',
                'validators' => [
                ],
                'renderable' => [
                    Renderable::LABEL => 'Description',
                    Renderable::SCHEMA_ITEMPROP => 'description',
                ],
            ],
        ];

        // generate basic model
        $model = Model::fromStruct(
            [
                'name' => 'BasicModel',
                'fields' => $basicFields
            ]
        );

        $codeGenerator = new TypescriptCodeGenerator();
        $fields = $codeGenerator->type($model);
        $this->assertStringContainsString('myAlpha: alpha', $fields);
        $this->assertStringContainsString('myBool: boolean', $fields);
        $this->assertStringContainsString('myBoolean: boolean', $fields);
        $this->assertStringContainsString('myInt: integer', $fields);
    }
}
