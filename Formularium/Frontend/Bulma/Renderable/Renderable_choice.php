<?php declare(strict_types=1); 

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Datatype\Datatype_choice;
use Formularium\Field;
use Formularium\Frontend\Bulma\RenderableBulmaTrait;
use Formularium\Frontend\HTML\Renderable\Renderable_choice as HTMLRenderable_choice;
use Formularium\HTMLElement;

class Renderable_choice extends \Formularium\Renderable
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
        $format = $field->getExtension(HTMLRenderable_choice::FORMAT_CHOOSER, HTMLRenderable_choice::FORMAT_CHOOSER_SELECT);
        
        if ($format == HTMLRenderable_choice::FORMAT_CHOOSER_RADIO) {
            $labels = [];
            // add extra classes
            foreach ($previous->get('.formularium-radio-item') as $container) {
                $label = $container->get('label')[0];
                $input = $container->get('input')[0];
                $labels[] = $label->prependContent($input)->addAttribute('class', 'radio');
            }
            $previous->get('.formularium-radio-group')[0]->setContent($labels);
        } else {
            // create a div around the old select
            $oldSelect = $previous->get('select')[0];
            $newSelect = clone $oldSelect;
            $oldSelect->setTag('div')->setAttribute('class', 'select')->setContent($newSelect);
        }

        foreach ($previous->getContent() as $e) {
            if ($e->getAttribute('class') === ['formularium-comment']) {
                $e->setTag('p')->setAttributes([
                    'class' => 'help',
                ]);
            }
        }

        return $previous;
    }
}
