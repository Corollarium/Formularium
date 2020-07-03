<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_association;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\HTMLElement;

class Renderable_associationSelect extends Renderable_association
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $input = new HTMLElement('select');
    
        $renderable = $field->getRenderables();
        $input->setAttributes([
                'id' => $field->getName() . Framework::counter(),
                'name' => $field->getName(),
                'class' => '',
                'data-attribute' => $field->getName(),
                'data-datatype' => $field->getDatatype()->getName(),
                'data-basetype' => $field->getDatatype()->getBasetype(),
                'title' => $field->getRenderable(static::LABEL, ''),
                'autocomplete' => 'off'
            ]);
    
        if (isset($renderable[static::PLACEHOLDER])) {
            $input->setAttribute('placeholder', $renderable[static::PLACEHOLDER]);
        }
        if ($field->getValidatorOption(Datatype::REQUIRED)) {
            $input->setAttribute('required', 'required');
        }
        /* TODO if ($validators[Datatype_association::MULTIPLE] ?? false) {
            $input->setAttribute('multiple', 'multiple');
        } */
        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($field->getRenderable($v, false)) {
                $input->setAttribute($v, $v);
            }
        }
    
        return $this->container($input, $field);
    }
}
