<?php declare(strict_types=1);

namespace Formularium\Frontend\VeeValidate;

use Formularium\HTMLNode;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'VeeValidate')
    {
        parent::__construct($name);
    }

    public function htmlHead(HTMLNode &$head)
    {
        $head->appendContent(
            [
                HTMLNode::factory(
                    'script',
                    [
                        'src' => "https://cdn.jsdelivr.net/npm/vee-validate@<3.0.0/dist/vee-validate.js"
                    ]
                ),
                HTMLNode::factory(
                    'script',
                    [ ],
                    'Vue.component("validation-provider", VeeValidate.ValidationProvider);'
                )
            ]
        );
    }

    public function setImports()
    {
        /* TODO
import * as rules from 'vee-validate/dist/rules';

Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule]);
});
        */
    }
}
