<?php

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\Framework;
use Formularium\Frontend\HTML\HTMLElement;

abstract class Renderable implements RenderableParameter
{
    /**
     * Factory.
     *
     * @param string $datatype
     * @param string $framework
     * @return Datatype
     */
    public static function factory($datatype, $framework): Renderable
    {
        if ($datatype instanceof Datatype) {
            $datatype = $datatype->getName();
        }
        if ($framework instanceof Framework) {
            $framework = $framework->getName();
        }
        $class = "\\Formularium\\Frontend\\$framework\\Renderable\\Renderable_$datatype";
        if (!class_exists($class)) {
            throw new Exception("Invalid datatype '$datatype' for $framework");
        }
        return new $class();
    }

    abstract public function viewable($value, Field $field, HTMLElement $previous) : HTMLElement;

    abstract public function editable($value, Field $field, HTMLElement $previous) : HTMLElement;
}
