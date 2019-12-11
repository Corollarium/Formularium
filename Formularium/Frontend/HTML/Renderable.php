<?php

namespace Formularium\Frontend\HTML;

use Formularium\Field;
use Formularium\HTMLElement;

abstract class Renderable extends \Formularium\Renderable implements \Formularium\Frontend\HTML\RenderableInterface
{
    protected function container(HTMLElement $content, Field $field): HTMLElement
    {
        $extensions = $field->getExtensions();
        $container = new HTMLElement(Framework::getEditableContainerTag(), [], $content);
        if (array_key_exists('label', $extensions)) {
            $container->prependContent(new HTMLElement('label', ['for' => $content->getAttribute('id')], $extensions['label']));
        }
        if (array_key_exists('comment', $extensions)) {
            $container->appendContent(new HTMLElement('div', ['class' => 'comment'], $extensions['comment']));
        }
        return $container;
    }
}
