<?php declare(strict_types=1); 

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_string;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

class Renderable_string extends Renderable
{
    public const MAX_STRING_SIZE = 1024;
    
    use \Formularium\Frontend\HTML\RenderableViewableTrait;

    public function editable($value, Field $f, HTMLElement $previous): HTMLElement
    {
        $input = new HTMLElement('input');

        $extensions = $f->getExtensions();
        $validators = $f->getValidators();
        $input->setAttributes([
            'id' => $f->getName() . Framework::counter(),
            'type' => ($extensions[static::HIDDEN] ?? false ? 'hidden' : 'text'),
            'name' => $f->getName(),
            'class' => '',
            'data-attribute' => $f->getName(),
            'data-datatype' => $f->getDatatype()->getName(),
            'data-basetype' => $f->getDatatype()->getBasetype(),
            'value' => $value,
            'maxlength' => static::MAX_STRING_SIZE,
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

        if (array_key_exists(Datatype_string::MIN_LENGTH, $validators)) {
            $input->setAttribute('minlength', $validators[Datatype_string::MIN_LENGTH]);
        }
        if (array_key_exists(Datatype_string::MAX_LENGTH, $validators)
            && $validators[Datatype_string::MAX_LENGTH] < static::MAX_STRING_SIZE // TODO: datatype
        ) {
            $input->setAttribute('maxlength', $validators[Datatype_string::MAX_LENGTH]);
        }
        if (isset($extensions[static::NO_AUTOCOMPLETE])) {
            $input->setAttribute('autocomplete', 'off');
        }

        return $this->container($input, $f);
    }
}
