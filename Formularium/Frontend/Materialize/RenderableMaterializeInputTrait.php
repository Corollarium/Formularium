<?php declare(strict_types=1);

namespace Formularium\Frontend\Materialize;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_string;
use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Validator\MaxLength;

trait RenderableMaterializeInputTrait
{
    use RenderableMaterializeTrait;

    /**
     * Subcall of wrapper editable()
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function viewable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        return $previous;
    }

    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLNode $previous
     * @return HTMLNode
     */
    public function _editable($value, Field $field, HTMLNode $previous): HTMLNode
    {
        // add extra classes
        $newContent = [];
        $input = $previous->get('input')[0];
        $input->addAttributes([
            'class' => 'validate',
        ]);

        $maxlength = $field->getValidatorOption(MaxLength::class, 'value', 0);
        if ($maxlength > 0) {
            $input->addAttribute('data-length', $maxlength);
        }

        $newContent[] = $input;
        $label = $previous->get('label');
        if (!empty($label)) {
            $newContent[] = $label[0];
        }
        $comment = $previous->get('.formularium-comment');
        if (!empty($comment)) {
            $comment[0]->setTag('span')->setAttributes([
                'class' => 'helper-text',
                'data-error' => "wrong",
                'data-success' => "right"
            ]);
            $newContent[] = $comment[0];
        }
        $previous->setContent($newContent);
        return $previous;
    }
}
