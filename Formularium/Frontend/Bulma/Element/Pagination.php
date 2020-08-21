<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Pagination as HTMLPagination;
use Formularium\Metadata;
use PHP_CodeSniffer\Generators\HTML;

class Pagination extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        foreach ($previous->get('.formularium-pagination-wrapper') as $e) {
            $e->addAttribute('class', 'pagination');
        }
        foreach ($previous->get('.formularium-disabled') as $e) {
            $e->addAttribute('class', 'disabled');
        }
        foreach ($previous->get('.formularium-ellipsis') as $e) {
            foreach ($e->getContent() as $e2) {
                $e2->setAttribute('class', 'pagination-ellipsis')
                    ->setTag('span');
            }
        }
        foreach ($previous->get('.formularium-pagination-link') as $e) {
            $e->addAttribute('class', 'pagination-link');
        }
        foreach ($previous->get('.formularium-pagination-current') as $e) {
            $e->addAttribute('class', 'is-current');
            foreach ($e->getContent() as $e2) {
                if ($e2 instanceof HTMLNode) {
                    $e2->addAttribute('class', 'is-current');
                }
            }
        }
        foreach ($previous->get('.formularium-pagination') as $e) {
            $e->addAttribute('class', 'pagination-list');
        }

        $size = $parameters[self::SIZE] ?? '';
        switch ($size) {
            case self::SIZE_LARGE:
                foreach ($previous->get('.formularium-pagination') as $e) {
                    $e->addAttribute('class', 'is-large');
                }
                break;
            case self::SIZE_SMALL:
                foreach ($previous->get('.formularium-pagination') as $e) {
                    $e->addAttribute('class', 'is-small');
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
