<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_file;
use Formularium\Field;
use Formularium\Frontend\Bulma\RenderableBulmaTrait;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

class Renderable_file extends Renderable
{
    use RenderableBulmaTrait;
    
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
        $renderable = $field->getRenderables();
        $validators = $field->getValidators();

        $input = $previous->get('input')[0];
        $input->addAttribute('class', 'file-input');

        $content = HTMLNode::factory(
            'div',
            ['class' => "file has-name"],
            [
                HTMLNode::factory(
                    'label',
                    ['class' => "file-label"],
                    [
                        $input,
                        HTMLNode::factory(
                            'span',
                            ['class' => "file-cta"],
                            [
                                HTMLNode::factory(
                                    'span',
                                    ['class' => "file-icon"],
                                    HTMLNode::factory(
                                        'i',
                                        [ 'class' => "fas fa-upload" ]
                                    )
                                ),
                                HTMLNode::factory(
                                    'span',
                                    ['class' => "file-label"],
                                    $renderable[Renderable::COMMENT] ?? 'Pick file or drag-drop'
                                ),
                            ]
                        ),
                        HTMLNode::factory(
                            'span',
                            ['class' => "formularium-file-name file-name"],
                            '' // TODO
                        )
                    ]
                ),
                HTMLNode::factory(
                    'label',
                    ['class' => "formularium-label"],
                    $renderable[Renderable::LABEL] ?? ''
                )
            ]
        );

        return $content;
    }
}
