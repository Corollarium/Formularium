<?php declare(strict_types=1); 

namespace Formularium\Frontend\Buefy;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

trait RenderableBuefyTrait
{
    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    abstract public function _editable($value, Field $field, HTMLElement $previous): HTMLElement;

    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        /** @var HTMLElement $base */
        $base = $this->_editable($value, $field, $previous);

        $renderable = $field->getRenderables();
        $base->setTag('b-field');

        if (array_key_exists(Renderable::LABEL, $renderable)) {
            $base->setAttribute('label', $renderable[Renderable::LABEL]);
        }
        if (array_key_exists(Renderable::COMMENT, $renderable)) {
            $base->setAttribute('message', $renderable[Renderable::COMMENT]);
        }
        $base->filter(function ($e) {
            if ($e instanceof HTMLElement) {
                if ($e->getTag() === 'label') {
                    return false;
                }
                if ($e->getTag() === 'div' && $e->getAttribute('class') === ['formularium-comment']) {
                    return false;
                }
            }
            return true;
        });

        return $base;
    }
}
