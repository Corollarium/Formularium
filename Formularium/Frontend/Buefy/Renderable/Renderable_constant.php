<?php declare(strict_types=1);

namespace Formularium\Frontend\Buefy\Renderable;

use Formularium\Field;
use Formularium\Frontend\Buefy\RenderableBuefyInputTrait;
use Formularium\HTMLElement;

class Renderable_constant extends \Formularium\Renderable
{
    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }
}
