<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_string;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;
use Formularium\Validator\Max;
use Formularium\Validator\MaxLength;
use Formularium\Validator\Min;
use Formularium\Validator\MinLength;

class Renderable_string extends Renderable
{
    public const MAX_STRING_SIZE = 1024;
    public const PASSWORD = 'PASSWORD';
    
    use \Formularium\Frontend\HTML\RenderableViewableTrait;

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $input = new HTMLNode('input');

        $renderable = $field->getRenderables();
        $validators = $field->getValidators();
        $input->setAttributes([
            'id' => $field->getName() . Framework::counter(),
            'type' => ($renderable[static::HIDDEN] ?? false ? 'hidden' : ($renderable[static::PASSWORD] ?? false ? 'password' : 'text')),
            'name' => $field->getName(),
            'class' => '',
            'data-attribute' => $field->getName(),
            'data-datatype' => $field->getDatatype()->getName(),
            'data-basetype' => $field->getDatatype()->getBasetype(),
            'value' => $value,
            'maxlength' => static::MAX_STRING_SIZE,
            'title' => $field->getRenderable(static::LABEL, '')
        ]);

        if (isset($renderable[static::PLACEHOLDER])) {
            $input->setAttribute('placeholder', $renderable[static::PLACEHOLDER]);
        }
        if ($validators[Datatype::REQUIRED] ?? false) {
            $input->setAttribute('required', 'required');
        }
        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($field->getRenderable($v, false)) {
                $input->setAttribute($v, $v);
            }
        }

        $min = $field->getValidatorOption(MinLength::class);
        if ($min) {
            $input->setAttribute('minlength', $min);
        }
        $max = $field->getValidatorOption(MaxLength::class);
        if ($max) {
            $input->setAttribute('maxlength', $max);
        }
        if (isset($renderable[static::NO_AUTOCOMPLETE])) {
            $input->setAttribute('autocomplete', 'off');
        }

        return $this->container($input, $field);
    }
}
