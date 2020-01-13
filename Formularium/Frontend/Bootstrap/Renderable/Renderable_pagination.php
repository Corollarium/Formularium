<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Renderable;

use Formularium\Field;
use Formularium\Renderable;
use Formularium\HTMLElement;

class Renderable_pagination extends Renderable_constant
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->fix($value, $field, $previous);
    }
    
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->fix($value, $field, $previous);
    }

    protected function fix($value, Field $field, HTMLElement $previous): HTMLElement
    {
        foreach ($previous->get('.formularium-disabled') as $e) {
            $e->addAttribute('class', 'disabled');
        }
        foreach ($previous->get('.formularium-pagination-item') as $e) {
            $e->addAttribute('class', 'page-item');
        }
        foreach ($previous->get('.formularium-pagination-link') as $e) {
            $e->addAttribute('class', 'page-link');
        }
        foreach ($previous->get('.formularium-pagination-current') as $e) {
            $e->addAttribute('class', 'disabled');
        }
        foreach ($previous->get('.formularium-pagination') as $e) {
            $e->addAttribute('class', 'pagination');
        }

        $size = $field->getExtension(Renderable::SIZE, '');
        switch ($size) {
            case Renderable::SIZE_LARGE:
                foreach ($previous->get('.formularium-pagination') as $e) {
                    $e->addAttribute('class', 'pagination-lg');
                }
                break;
            case Renderable::SIZE_SMALL:
                foreach ($previous->get('.formularium-pagination') as $e) {
                    $e->addAttribute('class', 'pagination-sm');
                }
                break;
        }
        return $previous;
    }
}
