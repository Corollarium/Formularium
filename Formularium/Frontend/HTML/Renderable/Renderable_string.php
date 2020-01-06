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
    public const PASSWORD = 'PASSWORD';
    
    use \Formularium\Frontend\HTML\RenderableViewableTrait;

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $input = new HTMLElement('input');

        $extensions = $field->getExtensions();
        $validators = $field->getValidators();
        $input->setAttributes([
            'id' => $field->getName() . Framework::counter(),
            'type' => ($extensions[static::HIDDEN] ?? false ? 'hidden' : ($extensions[static::PASSWORD] ?? false ? 'password' : 'text')),
            'name' => $field->getName(),
            'class' => '',
            'data-attribute' => $field->getName(),
            'data-datatype' => $field->getDatatype()->getName(),
            'data-basetype' => $field->getDatatype()->getBasetype(),
            'value' => $value,
            'maxlength' => static::MAX_STRING_SIZE,
            'title' => $field->getExtension(static::LABEL, '')
        ]);

        if (isset($extensions[static::PLACEHOLDER])) {
            $input->setAttribute('placeholder', $extensions[static::PLACEHOLDER]);
        }
        if ($validators[Datatype::REQUIRED] ?? false) {
            $input->setAttribute('required', 'required');
        }
        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($field->getExtension($v, false)) {
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

        return $this->container($input, $field);
    }
}
