<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Renderable;

use Formularium\Datatype;
use Formularium\Field;
use Formularium\Frontend\HTML\Renderable\Renderable_file as HTMLRenderable_file;
use Formularium\HTMLElement;
use Formularium\Renderable;
use Formularium\Validator\File;

class Renderable_file extends \Formularium\Renderable
{
    use \Formularium\Frontend\HTML\RenderableViewableTrait;

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $extensions = $field->getExtensions();
        $validators = $field->getValidators();

        $inputAtts = [
            'name' => $field->getName(),
            'v-model' => $field->getName(),
            'drag-drop' => ''
        ];
        if ($extensions[File::ACCEPT] ?? false) {
            if (is_array($extensions[File::ACCEPT])) {
                $accept = join(',', $extensions[File::ACCEPT]);
            } else {
                $accept = $extensions[File::ACCEPT];
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
            if ($field->getExtension($v, false)) {
                $inputAtts[$v] = true;
            }
        }

        $container = HTMLElement::factory(
            'b-field',
            [],
            HTMLElement::factory(
                'b-upload',
                $inputAtts,
                HTMLElement::factory(
                    'section',
                    ['class' => 'section'],
                    HTMLElement::factory(
                        'div',
                        ['class' => "content has-text-centered"],
                        [
                            HTMLElement::factory(
                                'p',
                                [],
                                HTMLElement::factory(
                                    'b-icon',
                                    [ 'icon' => "upload", 'size' => "is-large" ]
                                )
                            ),
                            HTMLElement::factory(
                                'p',
                                [ 'class' => 'formularium-label'],
                                $extensions[Renderable::LABEL] ?? ''
                            )
                        ]
                    )
                )
            )
        );

        return $container;
    }
}
