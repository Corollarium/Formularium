<?php declare(strict_types=1);

namespace FormulariumTests\CodeGenerator;

use Formularium\Frontend\HTML\Renderable;
use Formularium\Model;
use Formularium\CodeGenerator\GraphQL\CodeGenerator as GraphQLCodeGenerator;
use Formularium\Datatype;
use PHPUnit\Framework\TestCase;

class BaseCase extends TestCase
{
    protected function getBaseModel(): Model
    {
        /*
         * basic demo fiels
         */
        $basicFields = [
            'myAlpha' => [
                'datatype' => 'alpha',
                'validators' => [
                    Datatype::REQUIRED => [
                        'value' => true,
                    ]
                ],
                'renderable' => [
                    Renderable::LABEL => 'My Alpha',
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
                    Renderable::LABEL => 'Ipv4',
                    Renderable::SCHEMA_ITEMPROP => 'name',
                ],
            ],
            'myLanguage' => [
                'datatype' => 'language',
                'validators' => [
                ],
                'renderable' => [
                    Renderable::LABEL => 'Language',
                    Renderable::SCHEMA_ITEMPROP => 'name',
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
        return $model;
    }
}
