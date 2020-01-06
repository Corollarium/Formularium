<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_choice;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

class Renderable_choice extends Renderable
{
    public const FORMAT_CHOOSER = 'format_chooser';
    public const FORMAT_CHOOSER_SELECT = 'format_chooser_select';
    public const FORMAT_CHOOSER_RADIO = 'format_chooser_radio';
    public const LAYOUT_RADIO = 'inline';
    public const LAYOUT_RADIO_INLINE = 'inline';

    protected $format_chooser_default = self::FORMAT_CHOOSER_SELECT;

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
        $format = $field->getExtension(static::FORMAT_CHOOSER, $this->format_chooser_default);
        
        if ($format == static::FORMAT_CHOOSER_SELECT) {
            $element = $this->editableSelect($value, $field, $previous);
        } else {
            $element = $this->editableRadio($value, $field, $previous);
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

        $element = new HTMLElement(Framework::getEditableContainerTag(), ['class' => 'formularium-radio-group']);

        /**
         * @var Datatype_choice $datatype
         */
        $datatype = $field->getDatatype();
        foreach ($datatype->getChoices() as $v => $label) {
            $input = new HTMLElement('input');

            // send ids to delete/edit data later correctly.
            if ($value !== null && $v == $value) {
                $input->addAttribute('checked', 'checked');
            }
            $elementname = $field->getName(); // 'loh:' . $this->name . '[' . $attrid . '][value]' . '[' . $attrid . ']';
            $id = $field->getName() . Framework::counter();
            $input->addAttributes([
                'id' => $id,
                'name' => $elementname,
                'data-attribute' => $field->getName(),
                'data-datatype' => $datatype->getName(),
                'data-basetype' => $datatype->getBasetype(),
                'value' => $value,
                'type' => 'radio',
                'title' => $label
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
                'div',
                [
                    'class' => 'formularium-radio-item'
                ],
                [
                    $input,
                    new HTMLElement('label', ['class' => 'formularium-radio-label', 'for' => $id], [HTMLElement::factory('span', [], $label)])
                ]
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
        /**
         * @var Datatype_choice $datatype
         */
        $datatype = $field->getDatatype();

        if ($field->getValidators()[Datatype::REQUIRED] ?? false) {
            $optionEmpty = new HTMLElement('option', ['value' => ''], '', true);
            $element->addContent($optionEmpty);
        }

        foreach ($datatype->getChoices() as $v => $label) {
            $option = new HTMLElement('option', ['value' => $v], $label, true);

            if ($value == $v) {
                $option->setAttribute('selected', 'selected');
            }
            $element->addContent($option);
        }

        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($field->getExtension($v, false)) {
                $element->setAttribute($v, $v);
            }
        }

        return $element;
    }
}
