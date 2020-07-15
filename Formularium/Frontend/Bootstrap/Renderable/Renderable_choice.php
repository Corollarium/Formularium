<?php declare(strict_types=1); 

namespace Formularium\Frontend\Bootstrap\Renderable;

use Formularium\Datatype\Datatype_choice;
use Formularium\Field;
use Formularium\Frontend\Bootstrap\RenderableBootstrapTrait;
use Formularium\Frontend\HTML\Renderable\Renderable_choice as HTMLRenderable_choice;
use Formularium\HTMLNode;

class Renderable_choice extends \Formularium\Renderable
{
    use RenderableBootstrapTrait;
    
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function _editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        $format = $field->getRenderable(HTMLRenderable_choice::FORMAT_CHOOSER, HTMLRenderable_choice::FORMAT_CHOOSER_SELECT);
        
        if ($format == HTMLRenderable_choice::FORMAT_CHOOSER_RADIO) {
            // add extra classes
            foreach ($previous->get('[type=radio]') as $input) {
                $input->addAttribute('class', 'custom-control-input');
            }
            foreach ($previous->get('label.formularium-radio-label') as $label) {
                $label->addAttribute('class', 'custom-control-label');
            }
            $radioClass = 'custom-control custom-radio';
            if ($field->getRenderable(HTMLRenderable_choice::LAYOUT_RADIO, HTMLRenderable_choice::LAYOUT_RADIO_INLINE)) {
                $radioClass = 'custom-control custom-radio custom-control-inline';
            }
            foreach ($previous->get('[class=formularium-radio-item]') as $group) {
                $group->addAttribute('class', $radioClass);
            }
        } else {
            foreach ($previous->get('select') as $input) {
                $input->addAttribute('class', 'custom-select');
            }
        }

        return $previous;
    }
}
