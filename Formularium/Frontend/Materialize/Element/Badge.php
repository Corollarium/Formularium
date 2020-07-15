<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Element;

use Formularium\Element;
use Formularium\HTMLNode;

class Badge extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $badgeMode = ''; // TODO
        $previous->addAttribute('class', "badge");
        return $previous;
    }
}
