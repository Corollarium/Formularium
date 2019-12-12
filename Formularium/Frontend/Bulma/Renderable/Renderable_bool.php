<?php declare(strict_types=1); 

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Field;
use Formularium\Frontend\Bulma\RenderableBulmaTrait;
use Formularium\HTMLElement;

class Renderable_bool extends \Formularium\Renderable
{
    use RenderableBulmaTrait;
    
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $input = $previous->get('select');
        $input[0]->setAttributes([
            'class' => 'select',
        ]);
        $label = $previous->get('label');
        if (!empty($label)) {
            $label[0]->setAttributes([
                'class' => 'label',
            ]);
        }
        return $previous;
    }
}
