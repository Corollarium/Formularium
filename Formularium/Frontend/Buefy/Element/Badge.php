<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Element;

use Formularium\Element;
use Formularium\HTMLNode;

class Badge extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->setTag('b-tag');

        $badgeMode = 'badge-primary'; // TODO
        $previous->addAttribute('type', $badgeMode);

        return $previous;
    }
}
