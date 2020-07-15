<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Renderable;

use Formularium\Datatype;
use Formularium\Field;
use Formularium\Frontend\HTML\Renderable\Renderable_file as HTMLRenderable_file;
use Formularium\HTMLNode;
use Formularium\Renderable;
use Formularium\Validator\File;

class Renderable_file extends \Formularium\Renderable
{
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $renderable = $field->getRenderables();
        $validators = $field->getValidators();

        $inputAtts = [
            'name' => $field->getName(),
            'v-model' => $field->getName(),
            'drag-drop' => ''
        ];
        if ($renderable[File::ACCEPT] ?? false) {
            if (is_array($renderable[File::ACCEPT])) {
                $accept = join(',', $renderable[File::ACCEPT]);
            } else {
                $accept = $renderable[File::ACCEPT];
            }
            $inputAtts['accept'] = htmlspecialchars($accept);
        }
        if ($validators[Datatype::REQUIRED] ?? false) {
            $inputAtts['required'] = 'required';
        }
        if ($validators[File::MAX_SIZE] ?? false) {
            $inputAtts['data-max-size'] = $validators[File::MAX_SIZE];
        }
        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($field->getRenderable($v, false)) {
                $inputAtts[$v] = true;
            }
        }

        $container = HTMLNode::factory(
            'b-field',
            [],
            HTMLNode::factory(
                'b-upload',
                $inputAtts,
                HTMLNode::factory(
                    'section',
                    ['class' => 'section'],
                    HTMLNode::factory(
                        'div',
                        ['class' => "content has-text-centered"],
                        [
                            HTMLNode::factory(
                                'p',
                                [],
                                HTMLNode::factory(
                                    'b-icon',
                                    [ 'icon' => "upload", 'size' => "is-large" ]
                                )
                            ),
                            HTMLNode::factory(
                                'p',
                                [ 'class' => 'formularium-label'],
                                $renderable[Renderable::LABEL] ?? ''
                            )
                        ]
                    )
                )
            )
        );

        return $container;
    }

    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $tag = $field->getRenderable(Renderable::VIEWABLE_TAG, 'span');
        $atts = [
            'class' => 'formularium-viewable'
        ];
        $valueAtts = ['class' => 'formularium-value'];

        return HTMLNode::factory(
            'div',
            [],
            HTMLNode::factory(
                $tag,
                $atts,
                [
                    HTMLNode::factory(
                        'span',
                        ['class' => 'formularium-label'],
                        $field->getRenderable(\Formularium\Renderable::LABEL, '')
                    ),
                    HTMLNode::factory(
                        'span',
                        $valueAtts,
                        $value
                    )
                ]
            )
        );
    }
}
