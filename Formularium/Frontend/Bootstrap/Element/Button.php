<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Element;

use Formularium\Element;
use Formularium\Exception\Exception;
use Formularium\Frontend\HTML\Element\Button as HTMLButton;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Button extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->addAttribute('class', 'btn');

        $color = $parameters[HTMLButton::COLOR] ?? 'btn-primary';
        $colorMap = [
            HTMLButton::COLOR_PRIMARY => 'btn-primary',
            HTMLButton::COLOR_LINK => 'btn-link',
            HTMLButton::COLOR_INFO => 'btn-info',
            HTMLButton::COLOR_SUCCESS => 'btn-success',
            HTMLButton::COLOR_WARNING => 'btn-warning',
            HTMLButton::COLOR_ERROR => 'btn-error',
        ];
        if (array_key_exists($color, $colorMap)) {
            $color = $colorMap[$color];
        } else {
            $colors = [
                'btn-primary',
                'btn-secondary',
                'btn-success',
                'btn-danger',
                'btn-warning',
                'btn-info',
                'btn-light',
                'btn-dark',
                'btn-link',
            
                'btn-outline-primary',
                'btn-outline-secondary',
                'btn-outline-success',
                'btn-outline-danger',
                'btn-outline-warning',
                'btn-outline-info',
                'btn-outline-light',
                'btn-outline-dark',
            ];
            if (!in_array($color, $colors)) {
                throw new Exception('Invalid button color.');
            }
        }
        $previous->addAttribute('class', $color);

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

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLButton::getMetadata();
        $metadata->appendParameter(
            new MetadataParameter(
                HTMLButton::COLOR,
                'string',
                'Button color. Supports HTMLButton::COLOR_PRIMARY, HTMLButton::COLOR_LINK, HTMLButton::COLOR_INFO, HTMLButton::COLOR_SUCCESS, HTMLButton::COLOR_WARNING, HTMLButton::COLOR_ERROR and any Bootstrap button color classes. Default: primary.'
            )
        );
        return $metadata;
    }
}
