<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML;

use Formularium\Field;
use Formularium\HTMLElement;

abstract class Renderable extends \Formularium\Renderable implements \Formularium\Frontend\HTML\RenderableInterface
{
    protected function container(HTMLElement $content, Field $field): HTMLElement
    {
        $extensions = $field->getExtensions();
        $container = new HTMLElement(Framework::getEditableContainerTag(), [], $content);
        if (array_key_exists(Renderable::LABEL, $extensions)) {
            $container->prependContent(new HTMLElement('label', ['for' => $content->getAttribute('id'), 'class' => 'formularium-label'], $extensions[Renderable::LABEL]));
        }
        if (array_key_exists(Renderable::COMMENT, $extensions)) {
            $id = 'comment' . Framework::counter();
            $container->appendContent(new HTMLElement('div', ['class' => 'formularium-comment', 'id' => $id], $extensions[Renderable::COMMENT]));
            $content->addAttribute('aria-describedby', $id);
        }
        return $container;
    }
}
