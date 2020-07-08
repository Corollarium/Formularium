<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Renderable;

use Formularium\Field;
use Formularium\Frontend\Buefy\RenderableBuefyInputTrait;
use Formularium\Frontend\HTML\Renderable\Renderable_pagination as HTMLRenderable_pagination;
use Formularium\HTMLElement;

class Renderable_pagination extends \Formularium\Renderable
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->pagination($value, $field, $previous);
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->pagination($value, $field, $previous);
    }

    /**
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    protected function pagination($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $p = HTMLElement::factory(
            'b-pagination',
            [
                ':total' => $field->getName() . "." . HTMLRenderable_pagination::TOTAL_ITEMS,
                ':current.sync' => $field->getName() . "." . HTMLRenderable_pagination::CURRENT_PAGE,
                ':per-page' => $field->getName() . "." . HTMLRenderable_pagination::PER_PAGE
            ]
        );

        return $p;
    }
}
