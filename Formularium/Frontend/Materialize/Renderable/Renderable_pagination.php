<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Renderable;

use Formularium\Field;
use Formularium\Renderable;
use Formularium\HTMLNode;

class Renderable_pagination extends Renderable_constant
{
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $this->fix($value, $field, $previous);
    }
    
    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $this->fix($value, $field, $previous);
    }

    /**
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    protected function fix($value, Field $field, HTMLNode $previous): HTMLNode
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
