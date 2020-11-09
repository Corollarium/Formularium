<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuelidate;

use Formularium\HTMLNode;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'Vuelidate')
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
                        'src' => "https://cdn.jsdelivr.net/npm/vuelidate@0.7.6/dist/vuelidate.min.js"
                    ]
                ),
                HTMLNode::factory(
                    'script',
                    [
                        'src' => "https://cdn.jsdelivr.net/npm/vuelidate@0.7.6/dist/validators.min.js"
                    ]
                ),
                HTMLNode::factory(
                    'script',
                    [ ],
                    'Vue.use(window.vuelidate.default)'
                )
            ]
        );
    }
}
