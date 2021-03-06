<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Element;

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
            HTMLButton::COLOR_PRIMARY => 'is-primary',
            HTMLButton::COLOR_LINK => 'is-link',
            HTMLButton::COLOR_INFO => 'is-info',
            HTMLButton::COLOR_SUCCESS => 'is-success',
            HTMLButton::COLOR_WARNING => 'is-warning',
            HTMLButton::COLOR_ERROR => 'is-error',
        ];

        if (array_key_exists($color, $colorMap)) {
            $color = $parameters[HTMLButton::COLOR];
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
        $previous->addAttribute('type', $color);

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
