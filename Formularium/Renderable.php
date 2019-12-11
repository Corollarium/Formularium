<?php

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\HTMLElement;

abstract class Renderable implements RenderableParameter
{
    /**
     * Factory.
     *
     * @param string|Datatype $datatype
     * @param string|Framework $framework
     * @return Renderable
     */
    public static function factory($datatype, $framework): Renderable
    {
        if ($datatype instanceof Datatype) {
            $datatypeName = $datatype->getName();
        } else {
            $datatypeName = $datatype;
            $datatype = Datatype::factory($datatypeName);
        }

        if ($framework instanceof Framework) {
            $framework = $framework->getName();
        }
        $class = "\\Formularium\\Frontend\\$framework\\Renderable\\Renderable_$datatypeName";
        if (!class_exists($class)) {
            $basetype = $datatype->getBasetype();
            $class = "\\Formularium\\Frontend\\$framework\\Renderable\\Renderable_$basetype";
        }
        if (!class_exists($class)) {
            throw new Exception("Invalid datatype '$datatypeName' for $framework");
        }
        return new $class();
    }

    /**
     * Renders a view-only version of this renderable.
     *
     * @param mixed $value The value to render.
     * @param Field $field The field.
     * @param HTMLElement $previous The HTML coming from the previous composer.
     * @return HTMLElement The HTML rendered.
     */
    abstract public function viewable($value, Field $field, HTMLElement $previous): HTMLElement;

    /**
     * Renders a form editable version of this renderable
     *
     * @param mixed $value The value to render.
     * @param Field $field The field.
     * @param HTMLElement $previous The HTML coming from the previous composer.
     * @return HTMLElement The HTML rendered.
     */
    abstract public function editable($value, Field $field, HTMLElement $previous): HTMLElement;
}
