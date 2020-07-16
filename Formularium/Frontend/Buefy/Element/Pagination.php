<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Element;

use Formularium\Element;
use Formularium\Field;
use Formularium\Frontend\HTML\Element\Pagination as HTMLPagination;
use Formularium\HTMLNode;

class Pagination extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $name = $parameters[self::NAME] ?? 'paginator';
        $p = HTMLNode::factory(
            'b-pagination',
            [
                ':total' => $name . "." . HTMLPagination::TOTAL_ITEMS,
                ':current.sync' => $name . "." . HTMLPagination::CURRENT_PAGE,
                ':per-page' => $name . "." . HTMLPagination::PER_PAGE
            ]
        );

        return $p;
    }
}
