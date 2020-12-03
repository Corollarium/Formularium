<?php declare(strict_types=1);

namespace FormulariumTests\Renderable;

use Formularium\FrameworkComposer;
use Formularium\Frontend\HTML\Framework as FrameworkHTML;
use Formularium\Frontend\HTML\Renderable;
use Formularium\Model;

class SchemaTest extends RenderableBaseTestCase
{
    public function testItemprop()
    {
        $frameworkComposer = FrameworkComposer::create(['HTML']);
    
        /*
         * basic demo fiels
         */
        $basicFields = [
            'myString' => [
                'datatype' => 'string',
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
        $frameworkComposer->getByName('HTML')->setOptions([
            FrameworkHTML::SCHEMA_ITEMTYPE => "http://schema.org/Movie",
            FrameworkHTML::SCHEMA_ITEMSCOPE => true
        ]);
        $modelViewable = $model->viewable($frameworkComposer, ['myString' => 'Testing']);
        $this->assertContains('itemprop="name"', $modelViewable);
        $this->assertContains('itemscope=""', $modelViewable);
        $this->assertContains('itemtype="http://schema.org/Movie"', $modelViewable);
    }

    public function testItemprop2()
    {
        $frameworkComposer = FrameworkComposer::create(['HTML', 'Bootstrap', 'Vue']);
    
        /*
         * basic demo fiels
         */
        $basicFields = [
            'myString' => [
                'datatype' => 'string',
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
                'fields' => $basicFields,
                'renderable' => [
                    FrameworkHTML::SCHEMA_ITEMTYPE => "http://schema.org/Movie"
                ]
            ]
        );
        $modelViewable = $model->viewable($frameworkComposer, ['myString' => 'Testing']);
        $this->assertContains('itemprop="name"', $modelViewable);
        $this->assertContains('itemscope=""', $modelViewable);
        $this->assertContains('itemtype="http://schema.org/Movie"', $modelViewable);
    }
}
