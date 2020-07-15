<?php declare(strict_types=1); 

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLNode;

class Renderable_number extends Renderable
{
    public const STEP = 'step';

    use \Formularium\Frontend\HTML\RenderableViewableTrait;

    public function editable($value, Field $f, HTMLNode $previous): HTMLNode
    {
        $input = new HTMLNode('input');
        /** @var \Formularium\Datatype\Datatype_number $datatype */
        $datatype = $f->getDatatype();
    
        $renderable = $f->getRenderables();
        $validators = $f->getValidators();
        $input->setAttributes([
            'id' => $f->getName() . Framework::counter(),
            'type' => ($renderable[static::HIDDEN] ?? false ? 'hidden' : 'number'),
            'name' => $f->getName(),
            'class' => '',
            'data-attribute' => $f->getName(),
            'data-datatype' => $datatype->getName(),
            'data-basetype' => $datatype->getBasetype(),
            'value' => $value,
            'title' => $f->getRenderable(static::LABEL, '')
        ]);

        if (isset($renderable[static::PLACEHOLDER])) {
            $input->setAttribute('placeholder', $renderable[static::PLACEHOLDER]);
        }
        if ($validators[Datatype::REQUIRED] ?? false) {
            $input->setAttribute('required', 'required');
        }
        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($f->getRenderable($v, false)) {
                $input->setAttribute($v, $v);
            }
        }
    
        if (array_key_exists(static::STEP, $validators)) {
            $input->setAttribute('step', $validators[static::STEP]);
        }
        if (isset($renderable[static::NO_AUTOCOMPLETE])) {
            $input->setAttribute('autocomplete', 'off');
        }
    
        return $this->container($input, $f);
    }
}
