<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Element;

use Formularium\Element;
use Formularium\Field;
use Formularium\Frontend\HTML\Element\Pagination as HTMLPagination;
use Formularium\HTMLNode;
use Formularium\Metadata;

class Pagination extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        foreach ($previous->get('.formularium-disabled') as $e) {
            $e->addAttribute('class', 'disabled');
        }
        foreach ($previous->get('.formularium-pagination-item') as $e) {
            $e->addAttribute('class', 'page-item');
        }
        foreach ($previous->get('.formularium-pagination-ellipsis') as $e) {
            $e->addAttribute('class', 'disabled');
        }
        foreach ($previous->get('.formularium-pagination-link') as $e) {
            $e->addAttribute('class', 'page-link');
        }
        foreach ($previous->get('.formularium-pagination-current') as $e) {
            $e->addAttribute('class', 'active');
        }
        foreach ($previous->get('.formularium-pagination') as $e) {
            $e->addAttribute('class', 'pagination');
        }

        $size = $parameters[self::SIZE] ?? '';
        switch ($size) {
            case self::SIZE_LARGE:
                foreach ($previous->get('.formularium-pagination') as $e) {
                    $e->addAttribute('class', 'pagination-lg');
                }
                break;
            case self::SIZE_SMALL:
                foreach ($previous->get('.formularium-pagination') as $e) {
                    $e->addAttribute('class', 'pagination-sm');
                }
                break;
        }
        return $previous;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLPagination::getMetadata();
        return $metadata;
    }
}
