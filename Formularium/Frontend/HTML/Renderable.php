<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML;

use Formularium\Field;
use Formularium\HTMLElement;

abstract class Renderable extends \Formularium\Renderable implements \Formularium\Frontend\HTML\RenderableInterface
{
    protected function container(HTMLElement $content, Field $field): HTMLElement
    {
        $renderable = $field->getRenderables();
        $container = new HTMLElement(Framework::getEditableContainerTag(), [], $content);
        if (array_key_exists(Renderable::LABEL, $renderable)) {
            $container->prependContent(new HTMLElement('label', ['for' => $content->getAttribute('id'), 'class' => 'formularium-label'], $renderable[Renderable::LABEL]));
        }
        if (array_key_exists(Renderable::COMMENT, $renderable)) {
            $id = 'comment' . Framework::counter();
            $container->appendContent(new HTMLElement('div', ['class' => 'formularium-comment', 'id' => $id], $renderable[Renderable::COMMENT]));
            $content->addAttribute('aria-describedby', $id);
        }
        return $container;
    }
}
