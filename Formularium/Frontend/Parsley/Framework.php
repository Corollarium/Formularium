<?php declare(strict_types=1); 

namespace Formularium\Frontend\Parsley;

use Formularium\HTMLNode;
use Formularium\Model;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Parsley')
    {
        parent::__construct($name);
    }

    public function htmlFooter(HTMLNode &$footer)
    {
        $footer->appendContent([
            HTMLNode::factory('script', ['src' => "https://code.jquery.com/jquery-3.2.1.slim.min.js", 'integrity' => "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN", 'crossorigin' => "anonymous"]),
            HTMLNode::factory('script', ['src' => "https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.1/parsley.min.js"])
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
        return HTMLNode::factory('div', $atts, [$previousCompose], true)->getRenderHTML();
    }
}
