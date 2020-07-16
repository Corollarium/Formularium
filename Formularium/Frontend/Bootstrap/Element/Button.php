<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Element;

use Formularium\Element;
use Formularium\HTMLNode;

class Button extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->addAttribute('class', 'btn');

        // TODO button color $previous->addAttribute('class', 'is-vvvvv');
        $type = 'btn-primary';
        $previous->addAttribute('class', $type);

        $size = $parameters[self::SIZE] ?? '';
        switch ($size) {
            case self::SIZE_LARGE:
                $previous->addAttribute('class', 'btn-lg');
                break;
            case self::SIZE_SMALL:
                $previous->addAttribute('class', 'btn-sm');
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
                'i',
                [
                    'class' => $iconData,
                    'aria-hidden' => "true"
                ],
                []
            );
            $previous->addAttribute('class', 'has-icons-left');
            $previous->appendContent($iconElement);
        }

        return $previous;
    }
}
