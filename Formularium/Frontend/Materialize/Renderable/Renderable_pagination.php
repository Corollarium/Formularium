<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Renderable;

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
}
