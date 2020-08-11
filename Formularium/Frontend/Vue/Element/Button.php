<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue\Element;

use Formularium\Element;
use Formularium\Frontend\HTML\Element\Button as HTMLButton;
use Formularium\HTMLNode;
use Illuminate\Support\Str;

class Button extends HTMLButton
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        // convert to vue router
        $href = $previous->getAttribute('href'); // array?
        $href = $href[0] ?? '';
        if ($previous->getTag() === 'a' && $href && !Str::startsWith('http', $href) && !Str::startsWith('#', $href)) {
            $previous->setTag('router-link');
            $previous->removeAttribute('href');
            $previous->addAttribute(':to', "'" . $href . "'");
        }

        return $previous;
    }
}
