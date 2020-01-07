<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_time extends Renderable_string
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $input = $element->get('input')[0];
        $input->setAttributes(['type' => 'text', 'class' => 'timepicker']);
        $id = $input->getAttribute('id')[0];
        $element->appendContent(
            HTMLElement::factory(
                'script',
                [],
                "document.addEventListener('DOMContentLoaded', function() {
                    var elems = document.querySelectorAll('#${id}');
                    var options = {'format': 'yyyy-mm-dd'};
                    var instances = M.Timepicker.init(elems, options);
                });",
                true
            )
        );
        return $element;
    }
}
