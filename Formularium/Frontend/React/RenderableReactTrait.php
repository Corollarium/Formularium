<?php

namespace Formularium\Frontend\React;

use Formularium\Field;
use Formularium\HTMLElement;

trait RenderableReactTrait
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
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
            if (!empty($element->getAttribute('for'))) {
                $element->setAttribute('htmlFor', $element->getAttribute('for'));
                $element->removeAttribute('for');
            }
            if (!empty($element->getAttribute('class'))) {
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