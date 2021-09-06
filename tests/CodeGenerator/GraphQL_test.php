<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Frontend\HTML\Renderable;
use Formularium\Model;
use Formularium\CodeGenerator\GraphQL\CodeGenerator as GraphQLCodeGenerator;
use Formularium\Datatype;
use PHPUnit\Framework\TestCase;

final class GraphQLTest extends TestCase
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

        $codeGenerator = new GraphQLCodeGenerator();
        $fields = $codeGenerator->type($model);

        $this->assertStringContainsString('myAlpha: String!', $fields);
        $this->assertStringContainsString('myBool: Boolean!', $fields);
        $this->assertStringContainsString('myBoolean: Boolean!', $fields);
        $this->assertStringContainsString('myInt: Int!', $fields);
    }

    public function testToGraphql()
    {
        $modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someInteger' => [
                    'datatype' => 'integer',
                    'validators' => [
                        Min::class => [
                            'value' => 4,
                        ],
                        Max::class => [
                            'value' => 30,
                        ],
                        Datatype::REQUIRED => [
                            'value' => true,
                        ]
                    ]
                ],
                'someOther' => [
                    'datatype' => 'string',
                    'validators' => [
                        MinLength::class => [
                            'value' => 4,
                        ],
                        MaxLength::class => [
                            'value' => 30,
                        ],
                    ],
                    'renderable' => [
                        Renderable::LABEL => 'Some other'
                    ]
                ]
            ]
        ];
        $model = Model::fromStruct($modelData);

        // required
        $codeGenerator = new GraphQLCodeGenerator();
        $t = $codeGenerator->type($model);

        $this->assertStringContainsString("someInteger: Int\n", $t);
        $this->assertStringContainsString('someOther: String!', $t);

        $t = preg_replace('/\s+/', ' ', $t); // remove multiple white space
        $this->assertStringContainsString('@renderable( label: "Some other" )', $t);
    }
}
