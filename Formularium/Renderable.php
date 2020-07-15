<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;
use Formularium\HTMLNode;

/**
 * Abstract base classe to render datatypes. This class should be extended by frontends
 * for each datatype.
 */
abstract class Renderable implements RenderableParameter
{
    /**
     * Factory.
     *
     * @param string|Datatype $datatype
     * @param Framework $framework
     * @return Renderable
     */
    public static function factory($datatype, Framework $framework): Renderable
    {
        if ($datatype instanceof Datatype) {
            $datatypeName = $datatype->getName();
        } else {
            $datatypeName = $datatype;
            $datatype = DatatypeFactory::factory($datatypeName);
        }

        $frameworkClassname = get_class($framework);
        $lastpos = strrpos($frameworkClassname, '\\');
        if ($lastpos === false) {
            $ns = '';
        } else {
            $ns = '\\' . substr($frameworkClassname, 0, $lastpos);
        }
        $class = "$ns\\Renderable\\Renderable_$datatypeName";
        if (!class_exists($class)) {
            $basetype = $datatype->getBasetype();
            $class = "$ns\\Renderable\\Renderable_$basetype";
        }
        if (!class_exists($class)) {
            throw new ClassNotFoundException("Invalid datatype '$datatypeName' for {$framework->getName()}");
        }
        return new $class($framework);
    }

    /**
     * @var Framework
     */
    protected $framework;

    public function __construct(Framework $framework)
    {
        $this->framework = $framework;
    }
    /**
     * Renders a view-only version of this renderable.
     *
     * @param mixed $value The value to render.
     * @param Field $field The field.
     * @param HTMLNode $previous The HTML coming from the previous composer.
     * @return HTMLNode The HTML rendered.
     */
    abstract public function viewable($value, Field $field, HTMLNode $previous): HTMLNode;

    /**
     * Renders a form editable version of this renderable
     *
     * @param mixed $value The value to render.
     * @param Field $field The field.
     * @param HTMLNode $previous The HTML coming from the previous composer.
     * @return HTMLNode The HTML rendered.
     */
    abstract public function editable($value, Field $field, HTMLNode $previous): HTMLNode;
}
