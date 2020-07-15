<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Renderable;

use Formularium\Field;
use Formularium\Frontend\Bootstrap\RenderableBootstrapInputTrait;
use Formularium\Frontend\Bootstrap\RenderableBootstrapTrait;
use Formularium\HTMLNode;

class Renderable_file extends \Formularium\Renderable
{
    use RenderableBootstrapTrait;

    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

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
        $input->addAttribute('class', 'custom-file-input');
        $label = $previous->get('label')[0];
        
        return HTMLNode::factory(
            'div',
            [],
            [
                $label,
                HTMLNode::factory(
                    'div',
                    ['class' => "input-group mb-3"],
                    [
                        HTMLNode::factory(
                            'div',
                            ['class' => "input-group-prepend"],
                            HTMLNode::factory(
                                'span',
                                ['class' => "input-group-text"],
                                'Upload'
                            )
                        ),
                        HTMLNode::factory(
                            'div',
                            ['class' => "custom-file"],
                            [
                                $input,
                                HTMLNode::factory(
                                    'label',
                                    ['class' => "custom-file-label formularium-file-name"],
                                    'Choose file'
                                )
                            ]
                        )
                    ]
                )
            ]
        );
    }
}
