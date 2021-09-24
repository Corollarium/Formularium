<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Badge as HTMLBadge;
use Formularium\Metadata;

class Badge extends VuetifyElement
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->setTag('v-badge');
        
        $this->color($parameters, $previous);

        return $previous;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLBadge::getMetadata();
        return $metadata;
    }
}
