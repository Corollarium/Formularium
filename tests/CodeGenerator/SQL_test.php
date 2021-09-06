<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Frontend\HTML\Renderable;
use Formularium\Model;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;
use Formularium\DatabaseEnum;
use PHPUnit\Framework\TestCase;

final class SQLTest extends TestCase
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
            'myDescriptionText' => [
                'datatype' => 'text',
                'validators' => [
                ],
                'renderable' => [
                    Renderable::LABEL => 'Description',
                    Renderable::SCHEMA_ITEMPROP => 'description',
                ],
            ],
            'myIpv4' => [
                'datatype' => 'ipv4',
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

        $codeGenerator = new SQLCodeGenerator();
        $codeGenerator->setDatabase(DatabaseEnum::MYSQL);
        $fields = $codeGenerator->type($model);
        $this->assertStringContainsString('myAlpha VARCHAR(256) NOT NULL,', $fields);
        $this->assertStringContainsString('myBool BOOLEAN', $fields);
        $this->assertStringContainsString('myBoolean BOOLEAN', $fields);
        $this->assertStringContainsString('myInt INT NOT NULL,', $fields);
        $this->assertStringContainsString('myDescriptionText TEXT NOT NULL,', $fields);
        $this->assertStringContainsString('myIpv4 VARCHAR(15) NOT NULL', $fields);
    }
}
