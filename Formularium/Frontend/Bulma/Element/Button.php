<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma\Element;

use Formularium\Element;
use Formularium\Exception\Exception;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Button as HTMLButton;

class Button extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->addAttribute('class', 'button');


        $color = $parameters[HTMLButton::COLOR] ?? '';
        $colorMap = [
            HTMLButton::COLOR_PRIMARY => 'is-primary',
            HTMLButton::COLOR_LINK => 'is-link',
            HTMLButton::COLOR_INFO => 'is-info',
            HTMLButton::COLOR_SUCCESS => 'is-success',
            HTMLButton::COLOR_WARNING => 'is-warning',
            HTMLButton::COLOR_ERROR => 'is-error',
        ];
        if (array_key_exists($color, $colorMap)) {
            $color = $colorMap[$color];
        } else {
            $colors = [
                'is-primary',
                'is-success',
                'is-danger',
                'is-warning',
                'is-info',
                'is-light',
                'is-dark',
                'is-link',
                'is-black',
                'is-white',
            ];
            if (!in_array($color, $colors)) {
                throw new Exception('Invalid button color.');
            }
        }
        $previous->addAttribute('class', $color);

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
