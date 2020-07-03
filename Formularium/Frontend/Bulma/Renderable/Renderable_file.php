<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_file;
use Formularium\Field;
use Formularium\Frontend\Bulma\RenderableBulmaTrait;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

class Renderable_file extends Renderable
{
    use RenderableBulmaTrait;
    
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    /**
     * Subcall of wrapper editable()
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $renderable = $field->getRenderables();
        $validators = $field->getValidators();

        $input = $previous->get('input')[0];
        $input->addAttribute('class', 'file-input');

        $content = HTMLElement::factory(
            'div',
            ['class' => "file has-name"],
            [
                HTMLElement::factory(
                    'label',
                    ['class' => "file-label"],
                    [
                        $input,
                        HTMLElement::factory(
                            'span',
                            ['class' => "file-cta"],
                            [
                                HTMLElement::factory(
                                    'span',
                                    ['class' => "file-icon"],
                                    HTMLElement::factory(
                                        'i',
                                        [ 'class' => "fas fa-upload" ]
                                    )
                                ),
                                HTMLElement::factory(
                                    'span',
                                    ['class' => "file-label"],
                                    $renderable[Renderable::COMMENT] ?? 'Pick file or drag-drop'
                                ),
                            ]
                        ),
                        HTMLElement::factory(
                            'span',
                            ['class' => "formularium-file-name file-name"],
                            '' // TODO
                        )
                    ]
                ),
                HTMLElement::factory(
                    'label',
                    ['class' => "formularium-label"],
                    $renderable[Renderable::LABEL] ?? ''
                )
            ]
        );

        return $content;
    }
}
