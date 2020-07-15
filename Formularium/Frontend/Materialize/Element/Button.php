<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Element;

use Formularium\Element;
use Formularium\HTMLNode;

class Button extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $btnClass = 'btn';
        $size = $parameters[self::SIZE] ?? '';
        switch ($size) {
            case self::SIZE_LARGE:
                $btnClass = 'btn-large';
                break;
            case self::SIZE_SMALL:
                $btnClass = 'btn-small';
                break;
        }
        $previous->addAttribute('class', "$btnClass waves-effect waves-light");

        $icon = $parameters[self::ICON] ?? '';
        if ($icon) {
            $iconElement = HTMLNode::factory(
                'i',
                [ 'class' => "material-icons left" ],
                $icon
            );
            $previous->prependContent($iconElement);
        }

        return $previous;
    }
}
