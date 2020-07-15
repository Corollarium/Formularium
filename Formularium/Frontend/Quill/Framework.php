<?php declare(strict_types=1);

namespace Formularium\Frontend\Quill;

use Formularium\HTMLNode;

class Framework extends \Formularium\Framework
{
    /**
     * Support for Quill editor on html editors
     *
     * https://quilljs.com/docs/quickstart/
     *
     * @param string $name
     */
    public function __construct(string $name = 'Quill')
    {
        parent::__construct($name);
    }

    public function htmlHead(HTMLNode &$head)
    {
        $head->appendContent(
            HTMLNode::factory(
                'script',
                [
                    'src' => "https://cdn.quilljs.com/1.3.6/quill.min.js"
                ]
            )
        )->appendContent(
            HTMLNode::factory(
                'link',
                [
                    'rel' => "stylesheet",
                    'href' => "https://cdn.quilljs.com/1.3.6/quill.snow.css"
                    ]
            )
        );
    }
}
