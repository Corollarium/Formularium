<?php declare(strict_types=1); 

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

class Renderable_bool extends Renderable
{
    public const FORMAT_CHOOSER = 'format_chooser';
    public const FORMAT_CHOOSER_SELECT = 'format_chooser_select';
    public const FORMAT_CHOOSER_RADIO = 'format_chooser_radio';

    use \Formularium\Frontend\HTML\RenderableViewableTrait {
        viewable as _viewable;
    }
    
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $formatted = $field->getDatatype()->format($value, $field);

        return $this->_viewable($formatted, $field, $previous);
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        if (is_string($value)) {
            if ($value === 'true') {
                $value = true;
            } elseif ($value === 'false') {
                $value = false;
            } else {
                $value = null;
            }
        }

        $format = $field->getExtension(static::FORMAT_CHOOSER, static::FORMAT_CHOOSER_SELECT);
        
        if ($field->getValidators()[Datatype::REQUIRED] ?? false) {
            if ($format == static::FORMAT_CHOOSER_SELECT) {
                $element = $this->editableSelect($value, $field, $previous);
            } else {
                $element = $this->editableRadio($value, $field, $previous);
            }
        } else {
            $element = $this->editableSelect($value, $field, $previous);
        }

        return $this->container($element, $field);
    }

    /**
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    protected function editableRadio($value, Field $field, HTMLElement $previous): HTMLElement
    {
        if (empty($value) && array_key_exists(static::DEFAULTVALUE, $field->getExtensions())) {
            $value = $field->getExtensions()[static::DEFAULTVALUE];
        }

        $element = new HTMLElement('ul');

        $idcounter = 1;
        foreach ([true => 'True', false => 'False'] as $v => $label) {
            $input = new HTMLElement('input');

            // send ids to delete/edit data later correctly.
            if ($value !== null && $v == $value) {
                $input->addAttribute('checked', 'checked');
            }
            $elementname = $field->getName(); // 'loh:' . $this->name . '[' . $attrid . '][value]' . '[' . $attrid . ']';
            $id = $elementname . $idcounter++;
            $input->addAttributes([
                'id' => $field->getName() . Framework::counter(),
                'name' => $elementname,
                'data-attribute' => $field->getName(),
                'data-datatype' => $field->getDatatype()->getName(),
                'data-basetype' => $field->getDatatype()->getBasetype(),
                'value' => $value ? 'true' : 'false',
                'type' => 'radio',
                'title' => $field->getExtension(static::LABEL, '')
            ]);

            if ($field->getValidators()[Datatype::REQUIRED] ?? false) {
                $element->setAttribute('required', 'required');
            }
            foreach ([static::DISABLED, static::READONLY] as $p) {
                if ($field->getExtension($p, false)) {
                    $input->setAttribute($p, $p);
                }
            }
    
            $li = new HTMLElement(
                'li',
                [],
                [$input, new HTMLElement('label', ['for' => $id], [$label])]
            );
            $element->addContent($li);
        }
        return $element;
    }

    /**
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    protected function editableSelect($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = new HTMLElement('select');
        $element->setAttributes([
            'id' => $field->getName() . Framework::counter(),
            'name' => $field->getName(),
            'class' => '',
            'data-attribute' => $field->getName(),
            'data-datatype' => $field->getDatatype()->getName(),
            'data-basetype' => $field->getDatatype()->getBasetype(),
            'title' => $field->getExtension(static::LABEL, '')
        ]);

        $optionEmpty = new HTMLElement('option', ['value' => ''], '', true);
        $optionTrue = new HTMLElement('option', ['value' => 'true'], 'True', true);
        $optionFalse = new HTMLElement('option', ['value' => 'false'], 'False', true);

        if ($value) {
            $optionTrue->setAttribute('selected', 'selected');
        } elseif (!($value === null)) {
            $optionFalse->setAttribute('selected', 'selected');
        }

        if ($field->getValidators()[Datatype::REQUIRED] ?? false) {
            $element->addContent($optionEmpty);
        }
        $element->addContent($optionFalse);
        $element->addContent($optionTrue);

        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($field->getExtension($v, false)) {
                $element->setAttribute($v, $v);
            }
        }

        return $element;
    }
}
