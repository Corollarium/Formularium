<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Element;

use Formularium\Element as Element;
use Formularium\Exception\Exception;
use Formularium\HTMLNode;

abstract class VuetifyElement extends Element
{
    const COLOR = 'color';
    const COLOR_PRIMARY = 'primary';
    const COLOR_LINK = 'link';
    const COLOR_INFO = 'info';
    const COLOR_SUCCESS = 'success';
    const COLOR_WARNING = 'warning';
    const COLOR_ERROR = 'error';

    public function color(array $parameters, HTMLNode $node): HTMLNode
    {
        $color = $parameters[self::COLOR] ?? '';
        $colorMap = [
            self::COLOR_PRIMARY => 'primary',
            self::COLOR_LINK => 'anchor',
            self::COLOR_INFO => 'info',
            self::COLOR_SUCCESS => 'success',
            self::COLOR_WARNING => 'warning',
            self::COLOR_ERROR => 'error',
        ];

        if (array_key_exists($color, $colorMap)) {
            $color = $parameters[self::COLOR];
        } else {
            $colors = [
                'primary',
                'secondary',
                'helper',
                'accent',
                'anchor',
                'error',
                'info',
                'success',
                'warning',
            ];
            if (!in_array($color, $colors)) {
                throw new Exception('Invalid button color.');
            }
        }
        if ($color) {
            $node->addAttribute('color', $color);
        }
        return $node;
    }
}
