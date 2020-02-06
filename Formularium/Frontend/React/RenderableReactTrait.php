<?php declare(strict_types=1);

namespace Formularium\Frontend\React;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableReactTrait
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->fix($value, $field, $previous);
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->fix($value, $field, $previous);
    }

    /**
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    public function fix($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $previous->walk(function (HTMLElement $element) use ($field) {
            if ($element->getTag() === 'input') {
                if ($element->getAttribute('type') === ['checkbox']) {
                    $element->setAttribute('checked', "{this.state.{$field->getName()}}");
                } else {
                    $element->setAttribute('value', "{this.state.{$field->getName()}}");
                }
                $element->setAttribute('onChange', '{this.handleInputChange}');
            }
            if ($element->getTag() === 'textarea' || $element->getTag() === 'select') {
                $element->setAttribute('value', "{this.state.{$field->getName()}}");
                $element->setAttribute('onChange', '{this.handleInputChange}');
            }
            if ($element->getTag() === 'select') {
                $options = $element->get('[selected=selected]');
                if (!empty($options)) {
                    $element->setAttribute('value', $options[0]->getAttribute('value')[0]);
                }
            }
            if ($element->getTag() === 'option') {
                $element->removeAttribute('selected');
            }
            if ($element->hasAttribute('for')) {
                $element->setAttribute('htmlFor', $element->getAttribute('for'));
                $element->removeAttribute('for');
            }
            if ($element->hasAttribute('class')) {
                $element->setAttribute('className', $element->getAttribute('class'));
                $element->removeAttribute('class');
            }
            if (!empty($element->getAttribute('minlength'))) {
                $element->setAttribute('minLength', $element->getAttribute('minlength'));
                $element->removeAttribute('minlength');
            }
            if (!empty($element->getAttribute('maxlength'))) {
                $element->setAttribute('maxLength', $element->getAttribute('maxlength'));
                $element->removeAttribute('maxlength');
            }
        });
        return $previous;
    }
}
