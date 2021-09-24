<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Element;

use Formularium\Element;
use Formularium\Frontend\HTML\Element\Pagination as HTMLPagination;
use Formularium\HTMLNode;
use Formularium\Metadata;

class Pagination extends VuetifyElement
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $this->color($parameters, $previous);

        $name = $parameters[self::NAME] ?? 'paginator';
        $p = HTMLNode::factory(
            'v-pagination',
            [
                'v-model' => $name . "." . HTMLPagination::CURRENT_PAGE,
                ':length' => $name . "." . HTMLPagination::TOTAL_ITEMS,
            ]
        );

        return $p;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLPagination::getMetadata();
        return $metadata;
    }
}
