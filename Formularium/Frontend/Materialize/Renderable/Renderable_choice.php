<?php declare(strict_types=1); 

namespace Formularium\Frontend\Materialize\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;
use Formularium\Frontend\HTML\Renderable\Renderable_choice as HTMLRenderable_choice;
use Formularium\Frontend\Materialize\RenderableMaterializeTrait;

class Renderable_choice extends \Formularium\Renderable
{
    use RenderableMaterializeTrait;
    
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
        $newContent = [];
        $format = $field->getRenderable(HTMLRenderable_choice::FORMAT_CHOOSER, HTMLRenderable_choice::FORMAT_CHOOSER_SELECT);

        if ($format == HTMLRenderable_choice::FORMAT_CHOOSER_RADIO) {
            $labels = [];
            // add extra classes
            foreach ($previous->get('.formularium-radio-item') as $container) {
                $label = $container->get('label')[0];
                $input = $container->get('input')[0];
                $labels[] = HTMLElement::factory('p', [], $label->prependContent($input));
            }
            $previous->setContent($labels);
        } else {
            // add extra classes
            $input = $previous->get('select');
            $input[0]->removeAttribute('class');
            $id = $input[0]->getAttribute('id')[0];
            $newContent[] = $input[0];
            $label = $previous->get('label');
            if (!empty($label)) {
                $newContent[] = $label[0];
            }
            $comment = $previous->get('.formularium-comment');
            if (!empty($comment)) {
                $comment[0]->setTag('span')->setAttributes([
                    'class' => 'helper-text',
                    'data-error' => "wrong",
                    'data-success' => "right"
                ]);
                $newContent[] = $comment[0];
            }
            $script = HTMLElement::factory(
                'script',
                [],
                "document.addEventListener('DOMContentLoaded', function() {
                    var elems = document.querySelectorAll('#${id}');
                    var options = {};
                    var instances = M.FormSelect.init(elems, options);
                });",
                true
            );
            $newContent[] = $script;
            $previous->setContent($newContent);
        }
        return $previous;
    }
}
