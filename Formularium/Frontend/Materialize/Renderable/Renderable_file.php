<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Renderable;

use Formularium\Field;
use Formularium\Frontend\Materialize\RenderableMaterializeInputTrait;
use Formularium\HTMLNode;

class Renderable_file extends \Formularium\Renderable
{
    use RenderableMaterializeInputTrait;
    
    /**
     * Subcall of wrapper editable()
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function _editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        // add extra classes
        $input = $previous->get('input')[0];

        return HTMLNode::factory(
            'div',
            ['class' => 'file-field'],
            [
                HTMLNode::factory(
                    'div',
                    ['class' => "btn"],
                    [
                        HTMLNode::factory(
                            'span',
                            [],
                            'Upload'
                        ),
                        $input
                    ]
                ),
                HTMLNode::factory(
                    'div',
                    ['class' => "file-path-wrapper"],
                    HTMLNode::factory(
                        'input',
                        ['class' => 'file-path validate', 'type' => 'text']
                    )
                )
            ]
        );
    }
}
