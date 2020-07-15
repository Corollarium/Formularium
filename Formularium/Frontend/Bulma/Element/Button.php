<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma\Element;

use Formularium\Element;
use Formularium\HTMLNode;

class Button extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->addAttribute('class', 'button');

        // TODO button color $previous->addAttribute('class', 'is-vvvvv');

        $size = $parameters[self::SIZE] ?? '';
        switch ($size) {
            case self::SIZE_LARGE:
                $previous->addAttribute('class', 'is-large');
                break;
            case self::SIZE_SMALL:
                $previous->addAttribute('class', 'is-small');
                break;
        }

        $icon = $parameters[self::ICON] ?? '';
        if ($icon) {
            $iconData = [];
            $iconPack = $parameters[self::ICON_PACK] ?? '';
            if ($iconPack) {
                $iconData[] = $iconPack;
            }
            $iconData[] = $icon;
            $iconElement = HTMLNode::factory(
                'span',
                [
                    'class' => "icon is-small is-left",
                    'aria-hidden' => "true"
                ],
                [
                    HTMLNode::factory(
                        'i',
                        [ 'class' => $iconData ],
                        []
                    )
                ]
            );
            $previous->addAttribute('class', 'has-icons-left');
            $previous->appendContent($iconElement);
        }

        return $previous;
    }
}
