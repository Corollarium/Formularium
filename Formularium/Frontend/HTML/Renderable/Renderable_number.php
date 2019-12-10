<?php

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\HTMLElement;

class Renderable_number extends \Formularium\Renderable implements \Formularium\Frontend\HTML\RenderableInterface
{
    public const STEP = 'step';

    use \Formularium\Frontend\HTML\RenderableViewableTrait;

    public function editable($value, Field $f, HTMLElement $previous): HTMLElement
    {
        $input = new HTMLElement('input');
        /** @var \Formularium\Datatype\Datatype_number $datatype */
        $datatype = $f->getDatatype();
    
        $extensions = $f->getExtensions();
        $validators = $f->getValidators();
        $input->setAttributes([
            'id' => $f->getName() . Framework::counter(),
            'type' => ($extensions[static::HIDDEN] ?? false ? 'hidden' : 'number'),
            'name' => $f->getName(),
            'class' => '',
            'data-attribute' => $f->getName(),
            'data-datatype' => $datatype->getName(),
            'data-basetype' => $datatype->getBasetype(),
            'value' => $value,
            'title' => $f->getExtension(static::LABEL, '')
        ]);

        if (isset($extensions[static::PLACEHOLDER])) {
            $input->setAttribute('placeholder', $extensions[static::PLACEHOLDER]);
        }
        if ($validators[Datatype::REQUIRED] ?? false) {
            $input->setAttribute('required', 'required');
        }
        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($f->getExtension($v, false)) {
                $input->setAttribute($v, $v);
            }
        }
    
        if (array_key_exists(static::STEP, $validators)) {
            $input->setAttribute('step', $validators[static::STEP]);
        }
        if (isset($extensions[static::NO_AUTOCOMPLETE])) {
            $input->setAttribute('autocomplete', 'off');
        }
    
        $container = new HTMLElement(Framework::getEditableContainerTag(), [], $input);
        if (array_key_exists('label', $extensions)) {
            $container->prependContent(new HTMLElement('label', ['for' => $input->getAttribute('id')], $extensions['label']));
        }
        if (array_key_exists('comment', $extensions)) {
            $container->appendContent(new HTMLElement('div', ['class' => 'comment'], $extensions['comment']));
        }
        return $container;
    }
}
