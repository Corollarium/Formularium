<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Element;

use Formularium\Element;
use Formularium\HTMLNode;

class Button extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->setTag('b-button');

        // TODO button color $previous->addAttribute('class', 'is-vvvvv');

        $size = $parameters[self::SIZE] ?? '';
        switch ($size) {
            case self::SIZE_LARGE:
                $previous->addAttribute('size', 'is-large');
                break;
            case self::SIZE_SMALL:
                $previous->addAttribute('size', 'is-small');
                break;
        }

        $icon = $parameters[self::ICON] ?? '';
        if ($icon) {
            $previous->addAttribute('icon-left', $icon);
        }

        return $previous;
    }
}
