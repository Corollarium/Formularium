<?php

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\Frontend\HTML\HTMLElement;

class Renderable_bool extends \Formularium\Renderable
{
    const FORMAT_CHOOSER = 'format_chooser';
    const FORMAT_CHOOSER_SELECT = 'format_chooser_select';
    const FORMAT_CHOOSER_RADIO = 'format_chooser_radio';

    use \Formularium\Frontend\HTML\RenderableViewableTrait {
        viewable as _viewable;
    }
    
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $formatedV = '';
        $dataV = '';
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
        if ($field->getExtension('required', false)) {
            if ($format == static::FORMAT_CHOOSER_SELECT) {
                return $this->editableSelect($value, $field, $previous);
            } else {
                return $this->editableRadio($value, $field, $previous);
            }
        } else {
            return $this->editableSelect($value, $field, $previous);
        }
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
            $value =  $field->getExtensions()[static::DEFAULTVALUE];
        }

        $element = new HTMLElement('ul');

        $attrid = -1; // TODO: should work because it's unique
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
                'name' => $elementname,
                'data-attribute' => $field->getName(),
                'data-datatype' => $field->getDatatype()->getName(),
                'data-basetype' => $field->getDatatype()->getBasetype(),
                'value' => $value ? 'true' : 'false',
                'type' => 'radio',
                'title' => $field->getExtension(static::LABEL, '')
            ]);

            foreach (array(static::DISABLED, static::READONLY, static::REQUIRED) as $v) {
                if ($field->getExtension($v, false)) {
                    $input->setAttribute($v, $v);
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
        $extensions = $field->getExtensions();
        $validators = $field->getValidators();
        $element->setAttributes([
            'type' => (($extensions[static::HIDDEN] ?? false) ? 'hidden' : 'text'),
            'name' => $field->getName(),
            'class' => '',
            'data-attribute' => $field->getName(),
            'data-datatype' => $field->getDatatype()->getName(),
            'data-basetype' => $field->getDatatype()->getBasetype(),
            'title' => $field->getExtension(static::LABEL, '')
        ]);

        $optionEmpty = new HTMLElement('option', array('value' => ''), '', true);
        $optionTrue = new HTMLElement('option', array('value' => 'true'), 'True', true);
        $optionFalse = new HTMLElement('option', array('value' => 'false'), 'False', true);

        if ($value) {
            $optionTrue->setAttribute('selected', 'selected');
        } elseif (!($value === null)) {
            $optionFalse->setAttribute('selected', 'selected');
        }

        if ($field->getExtension('required', false)) {
            $element->addContent($optionEmpty);
        }
        $element->addContent($optionFalse);
        $element->addContent($optionTrue);

        foreach (array(static::DISABLED, static::READONLY, static::REQUIRED) as $v) {
            if ($field->getExtension($v, false)) {
                $element->setAttribute($v, $v);
            }
        }

        return $element;
    }
}
