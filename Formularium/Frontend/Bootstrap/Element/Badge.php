<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Element;

use Formularium\Element;
use Formularium\HTMLNode;

class Badge extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $badgeMode = 'badge-primary'; // TODO
        $previous->addAttribute('class', "badge $badgeMode");
        return $previous;
    }
}
