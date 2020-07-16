<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Pagination as HTMLPagination;
use Formularium\Metadata;

class Pagination extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        foreach ($previous->get('.formularium-disabled') as $e) {
            $e->addAttribute('class', 'disabled');
        }
        foreach ($previous->get('.formularium-pagination-item') as $e) {
            $e->addAttribute('class', 'waves-effect');
        }
        foreach ($previous->get('.formularium-pagination-current') as $e) {
            $e->addAttribute('class', 'active');
        }
        foreach ($previous->get('.formularium-pagination') as $e) {
            $e->addAttribute('class', 'pagination');
        }

        $x = $previous->get('ul');
        return $x ? $x[0] : $previous;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLPagination::getMetadata();
        return $metadata;
    }
}
