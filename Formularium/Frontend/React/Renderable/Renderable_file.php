<?php declare(strict_types=1);

namespace Formularium\Frontend\React\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;
use Formularium\Frontend\React\RenderableReactTrait;

class Renderable_file extends \Formularium\Renderable
{
    use RenderableReactTrait {
        RenderableReactTrait::editable as _editable;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $previous->filter(
            function ($e) {
                if ($e->getTag() === 'canvas') {
                    return false;
                }
                if ($e->hasAttribute('style')) {
                    return false;
                }
                return true;
            }
        );

        return $this->fix($value, $field, $previous);
    }
}
