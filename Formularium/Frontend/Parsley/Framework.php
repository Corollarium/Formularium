<?php

namespace Formularium\Frontend\Parsley;

use Formularium\HTMLElement;
use Formularium\Model;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Parsley')
    {
        parent::__construct($name);
    }

    public function htmlFooter(HTMLElement &$footer)
    {
        $footer->appendContent([
            HTMLElement::factory('script', ['src' => "https://code.jquery.com/jquery-3.2.1.slim.min.js", 'integrity' => "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN", 'crossorigin' => "anonymous"]),
            HTMLElement::factory('script', ['src' => "https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.1/parsley.min.js"])
        ]);
    }

    public function form(HTMLElement $form)
    {
        $form->setAttributes([
            'data-parsley-success-class' => 'asdfasdf'
        ]);
    }
 
    public function editableCompose(Model $m, array $elements, string $previousCompose): string
    {
        // TODO: these are bootstrap classes
        $atts = [
            'data-parsley-validate' => '',
            'data-parsley-trigger' => "change",
            'data-parsley-error-class' => "is-invalid",
            'data-parsley-success-class' => "is-valid",
            'data-parsley-errors-wrapper' => "<span class='invalid-feedback'></span>",
            'data-parsley-error-template' => "<div></div>"
        ];
        return HTMLElement::factory('div', $atts, [$previousCompose], true)->getRenderHTML();
    }
}
