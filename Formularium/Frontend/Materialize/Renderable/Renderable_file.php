<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Renderable;

use Formularium\Field;
use Formularium\Frontend\Materialize\RenderableMaterializeInputTrait;
use Formularium\HTMLElement;

class Renderable_file extends \Formularium\Renderable
{
    use RenderableMaterializeInputTrait;
    
    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $input = $previous->get('input')[0];

        return HTMLElement::factory(
            'div',
            ['class' => 'file-field'],
            [
                HTMLElement::factory(
                    'div',
                    ['class' => "btn"],
                    [
                        HTMLElement::factory(
                            'span',
                            [],
                            'Upload'
                        ),
                        $input
                    ]
                ),
                HTMLElement::factory(
                    'div',
                    ['class' => "file-path-wrapper"],
                    HTMLElement::factory(
                        'input',
                        ['class' => 'file-path validate', 'type' => 'text']
                    )
                )
            ]
        );
    }
}
