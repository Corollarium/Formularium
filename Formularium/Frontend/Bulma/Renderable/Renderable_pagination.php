<?php declare(strict_types=1);

namespace Formularium\Frontend\Bulma\Renderable;

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

    /**
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    protected function fix($value, Field $field, HTMLElement $previous): HTMLElement
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
            foreach ($e->getContent() as $e2) {
                $e2->addAttribute('class', 'is-current');
            }
        }
        foreach ($previous->get('.formularium-pagination') as $e) {
            $e->addAttribute('class', 'pagination-list');
        }

        $size = $field->getExtension(Renderable::SIZE, '');
        switch ($size) {
            case Renderable::SIZE_LARGE:
                foreach ($previous->get('.formularium-pagination') as $e) {
                    $e->addAttribute('class', 'is-large');
                }
                break;
            case Renderable::SIZE_SMALL:
                foreach ($previous->get('.formularium-pagination') as $e) {
                    $e->addAttribute('class', 'is-small');
                }
                break;
        }
        return $previous;
    }
}
