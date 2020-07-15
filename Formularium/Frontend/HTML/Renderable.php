<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML;

use Formularium\Frontend\HTML\Framework as HTMLFramework;
use Formularium\Field;
use Formularium\HTMLNode;

abstract class Renderable extends \Formularium\Renderable implements \Formularium\Frontend\HTML\RenderableInterface
{
    /**
     * @var HTMLFramework
     */
    protected $framework;

    protected function container(HTMLNode $content, Field $field): HTMLNode
    {
        $renderable = $field->getRenderables();
        $container = new HTMLNode($this->framework->getEditableContainerTag(), [], $content);
        if (array_key_exists(Renderable::LABEL, $renderable)) {
            $container->prependContent(new HTMLNode('label', ['for' => $content->getAttribute('id'), 'class' => 'formularium-label'], $renderable[Renderable::LABEL]));
        }
        if (array_key_exists(Renderable::COMMENT, $renderable)) {
            $id = 'comment' . $this->framework->counter();
            $container->appendContent(new HTMLNode('div', ['class' => 'formularium-comment', 'id' => $id], $renderable[Renderable::COMMENT]));
            $content->addAttribute('aria-describedby', $id);
        }
        return $container;
    }
}
