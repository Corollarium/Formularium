<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Renderable;

use Formularium\Field;
use Formularium\Frontend\Bootstrap\RenderableBootstrapInputTrait;
use Formularium\Frontend\Bootstrap\RenderableBootstrapTrait;
use Formularium\HTMLElement;

class Renderable_file extends \Formularium\Renderable
{
    use RenderableBootstrapTrait;

    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $input = $previous->get('input')[0];
        $input->addAttribute('class', 'custom-file-input');
        $label = $previous->get('label')[0];
        
        return HTMLElement::factory(
            'div',
            [],
            [
                $label,
                HTMLElement::factory(
                    'div',
                    ['class' => "input-group mb-3"],
                    [
                        HTMLElement::factory(
                            'div',
                            ['class' => "input-group-prepend"],
                            HTMLElement::factory(
                                'span',
                                ['class' => "input-group-text"],
                                'Upload'
                            )
                        ),
                        HTMLElement::factory(
                            'div',
                            ['class' => "custom-file"],
                            [
                                $input,
                                HTMLElement::factory(
                                    'label',
                                    ['class' => "custom-file-label"],
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
