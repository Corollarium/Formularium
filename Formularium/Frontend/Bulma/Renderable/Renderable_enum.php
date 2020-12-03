<?php declare(strict_types=1); 

namespace Formularium\Frontend\Bulma\Renderable;

use Formularium\Datatype\Datatype_enum;
use Formularium\Field;
use Formularium\Frontend\Bulma\RenderableBulmaTrait;
use Formularium\Frontend\HTML\Renderable\Renderable_enum as HTMLRenderable_enum;
use Formularium\HTMLNode;

class Renderable_enum extends \Formularium\Renderable
{
    use RenderableBulmaTrait;
    
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
        $format = $field->getRenderable(HTMLRenderable_enum::FORMAT_CHOOSER, HTMLRenderable_enum::FORMAT_CHOOSER_SELECT);
        
        if ($format == HTMLRenderable_enum::FORMAT_CHOOSER_RADIO) {
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
