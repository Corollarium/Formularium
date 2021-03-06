<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_enum;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

class Renderable_enum extends Renderable
{
    public const FORMAT_CHOOSER = 'format_chooser';
    public const FORMAT_CHOOSER_SELECT = 'format_chooser_select';
    public const FORMAT_CHOOSER_RADIO = 'format_chooser_radio';
    public const LAYOUT_RADIO = 'inline';
    public const LAYOUT_RADIO_INLINE = 'inline';

    /**
     * Default value for format chooset
     *
     * @var string
     */
    protected $format_chooser_default = self::FORMAT_CHOOSER_SELECT;

    use \Formularium\Frontend\HTML\RenderableViewableTrait {
        viewable as _viewable;
    }
    
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $formatted = $field->getDatatype()->format($value);

        return $this->_viewable($formatted, $field, $previous);
    }

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $format = $field->getRenderable(static::FORMAT_CHOOSER, $this->format_chooser_default);
        
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
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    protected function editableRadio($value, Field $field, HTMLNode $previous): HTMLNode
    {
        if (empty($value) && array_key_exists(static::DEFAULTVALUE, $field->getRenderables())) {
            $value = $field->getRenderables()[static::DEFAULTVALUE];
        }

        $element = new HTMLNode($this->framework->getEditableContainerTag(), ['class' => 'formularium-radio-group']);

        /**
         * @var Datatype_enum $datatype
         */
        $datatype = $field->getDatatype();
        foreach ($datatype->getChoices() as $v => $label) {
            $input = new HTMLNode('input');

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
                if ($field->getRenderable($p, false)) {
                    $input->setAttribute($p, $p);
                }
            }
    
            $li = new HTMLNode(
                'div',
                [
                    'class' => 'formularium-radio-item'
                ],
                [
                    $input,
                    new HTMLNode('label', ['class' => 'formularium-radio-label', 'for' => $id], [HTMLNode::factory('span', [], $label)])
                ]
            );
            $element->addContent($li);
        }

        return $element;
    }

    /**
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    protected function editableSelect($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $element = new HTMLNode('select');
        $element->setAttributes([
            'id' => $field->getName() . Framework::counter(),
            'name' => $field->getName(),
            'class' => '',
            'data-attribute' => $field->getName(),
            'data-datatype' => $field->getDatatype()->getName(),
            'data-basetype' => $field->getDatatype()->getBasetype(),
            'title' => $field->getRenderable(static::LABEL, '')
        ]);

        $optionEmpty = new HTMLNode('option', ['value' => ''], '', true);
        /**
         * @var Datatype_enum $datatype
         */
        $datatype = $field->getDatatype();

        if ($field->getValidators()[Datatype::REQUIRED] ?? false) {
            $optionEmpty = new HTMLNode('option', ['value' => ''], '', true);
            $element->addContent($optionEmpty);
        }

        foreach ($datatype->getChoices() as $v => $label) {
            $option = new HTMLNode('option', ['value' => $v], $label, true);

            if ($value == $v) {
                $option->setAttribute('selected', 'selected');
            }
            $element->addContent($option);
        }

        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($field->getRenderable($v, false)) {
                $element->setAttribute($v, $v);
            }
        }

        return $element;
    }
}
