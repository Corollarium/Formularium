<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\Frontend\HTML\Element\Upload as HTMLUpload;

class Upload extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->addAttribute('class', 'custom-file');
        /**
         * @var HTMLNode $input
         */
        $input = $previous->get('input')[0];
        $input->addAttribute('class', 'custom-file-input');
        $label = $previous->get('label')[0];
        $label->addAttribute('class', 'custom-file-label');

        return $previous;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLUpload::getMetadata();
        return $metadata;
    }
}
