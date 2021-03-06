<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Badge as HTMLBadge;
use Formularium\Metadata;

class Badge extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $badgeMode = 'badge-primary'; // TODO
        $previous->addAttribute('class', "badge $badgeMode");
        return $previous;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLBadge::getMetadata();
        return $metadata;
    }
}
