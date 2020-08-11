<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue\Element;

use Formularium\Element;
use Formularium\Frontend\HTML\Element\Pagination as HTMLPagination;
use Formularium\HTMLNode;
use Formularium\Metadata;

class Pagination extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $name = $parameters[self::NAME] ?? 'paginator';
        $p = HTMLNode::factory(
            'b-pagination',
            [
                'v-model' => $name . "." . HTMLPagination::CURRENT_PAGE,
                ':total-rows' => $name . "." . HTMLPagination::TOTAL_ITEMS,
                ':per-page' => $name . "." . HTMLPagination::PER_PAGE,
                // TODO 'aria-controls' =>
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
