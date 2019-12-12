<?php declare(strict_types=1); 

namespace Formularium\Frontend\Bootstrap;

use Formularium\Field;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;

trait RenderableBootstrapInputTrait
{
    use RenderableBootstrapTrait;

    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $previous;
    }

    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    public function _editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        // add extra classes
        $input = $previous->get('input');
        $input[0]->addAttributes([
            'class' => 'form-control',
        ]);
        $comment = $previous->get('.formularium-comment');
        if (!empty($comment)) {
            $comment[0]->setTag('small')->addAttributes([
                'class' => 'form-text text-muted',
            ]);
        }
        $size = $field->getExtension(Renderable::SIZE, '');
        switch ($size) {
            case Renderable::SIZE_LARGE:
                $input[0]->addAttribute('class', 'form-control-lg');
                break;
            case Renderable::SIZE_SMALL:
                $input[0]->addAttribute('class', 'form-control-sm');
                break;
        }
        return $previous;
    }
}
