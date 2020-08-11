<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

trait RenderableBootstrapvueTrait
{
    /**
     * Subcall of wrapper editable() from RenderableTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    abstract public function _editable($value, Field $field, HTMLNode $previous): HTMLNode;

    public function editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        /** @var HTMLNode $base */
        $base = $this->_editable($value, $field, $previous);

        $renderable = $field->getRenderables();
        $base->setTag('b-form-group');

        if (array_key_exists(Renderable::LABEL, $renderable)) {
            $base->setAttribute('label', $renderable[Renderable::LABEL]);
        }
        if (array_key_exists(Renderable::COMMENT, $renderable)) {
            $base->appendContent(
                HTMLNode::factory(
                    'b-form-text',
                    [],
                    $renderable[Renderable::COMMENT]
                )
            );
        }
        $base->filter(function ($e) {
            if ($e instanceof HTMLNode) {
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
