<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue\Element;

use Formularium\Element;
use Formularium\Exception\Exception;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Button as HTMLButton;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Button extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->setTag('b-button');

        $color = $parameters[HTMLButton::COLOR] ?? '';
        $colorMap = [
            HTMLButton::COLOR_PRIMARY => 'primary',
            HTMLButton::COLOR_LINK => 'link',
            HTMLButton::COLOR_INFO => 'info',
            HTMLButton::COLOR_SUCCESS => 'success',
            HTMLButton::COLOR_WARNING => 'warning',
            HTMLButton::COLOR_ERROR => 'error',
        ];

        if (array_key_exists($color, $colorMap)) {
            $color = $parameters[HTMLButton::COLOR];
        } else {
            $colors = [
                'primary',
                'success',
                'danger',
                'warning',
                'info',
                'link',
                'light',
                'dark',
            ];
            if (!in_array($color, $colors)) {
                throw new Exception('Invalid button color.');
            }
        }
        $previous->addAttribute('variant', $color);

        $size = $parameters[self::SIZE] ?? '';
        switch ($size) {
            case self::SIZE_LARGE:
                $previous->addAttribute('size', 'lg');
                break;
            case self::SIZE_SMALL:
                $previous->addAttribute('size', 'sm');
                break;
        }

        // TODO $icon = $parameters[self::ICON] ?? '';

        return $previous;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLButton::getMetadata();
        $metadata->appendParameter(
            new MetadataParameter(
                HTMLButton::COLOR,
                'string',
                'Button color. Supports HTMLButton::COLOR_PRIMARY, HTMLButton::COLOR_LINK, HTMLButton::COLOR_INFO, HTMLButton::COLOR_SUCCESS, HTMLButton::COLOR_WARNING, HTMLButton::COLOR_ERROR. Default: primary.'
            )
        );
        return $metadata;
    }
}
