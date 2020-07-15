<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Element;

use Formularium\Element;
use Formularium\HTMLNode;

class Button extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $node = new HTMLNode('button');

        $node->setAttributes([
            'type' => 'submit', // TODO
            'class' => '',
        ]);

        $node->setContent($parameters[self::LABEL] ?? '');

        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($parameters[$v] ?? false) {
                $node->setAttribute($v, $v);
            }
        }

        return $node;
    }
}
