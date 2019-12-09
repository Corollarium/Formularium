<?php

namespace Formularium\Frontend\Materialize\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class Renderable_date extends Renderable_string
{
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $element = parent::editable($value, $field, $previous);
        $input = $element->get('input')[0];
        $input->setAttributes(['type' => 'text', 'class' => 'datepicker']);
        $id = $input->getAttribute('id')[0];
        $element->appendContent(
            HTMLElement::factory(
                'script',
                [],
                "document.addEventListener('DOMContentLoaded', function() {
                    var elems = document.querySelectorAll('#${id}');
                    var options = {'format': 'yyyy-mm-dd'};
                    var instances = M.Datepicker.init(elems, options);
                });",
                true
            )
        );
        return $element;
    }
}
