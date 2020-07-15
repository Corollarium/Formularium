<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\HTMLNode;

/**
 * Abstract base classe to render HTML elements such as buttons.
 */
abstract class Element implements RenderableParameter
{
    /**
     * Factory.
     *
     * @param string $elementName
     * @param Framework $framework
     * @return Element
     */
    public static function factory(string $elementName, Framework $framework): Element
    {
        // TODO: use reflection like Datatype
        $frameworkClassname = get_class($framework);
        $lastpos = strrpos($frameworkClassname, '\\');
        if ($lastpos === false) {
            $ns = '';
        } else {
            $ns = '\\' . substr($frameworkClassname, 0, $lastpos);
        }
        $class = "$ns\\Element\\$elementName";
        if (!class_exists($class)) {
            throw new ClassNotFoundException("Invalid element $elementName for {$framework->getName()}");
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
     * Renders a form editable version of this Element
     *
     * @param array $parameters
     * @param HTMLNode $previous
     * @return HTMLNode The HTML rendered.
     */
    abstract public function render(array $parameters, HTMLNode $previous): HTMLNode;
}
