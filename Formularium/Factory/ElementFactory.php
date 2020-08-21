<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Element;
use Formularium\Exception\ClassNotFoundException;
use Formularium\FrameworkComposer;
use Formularium\Framework;

final class ElementFactory
{
    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * Factory.
     *
     * @param string $elementName
     * @param Framework $framework
     * @param FrameworkComposer $composer
     * @return Element
     */
    public static function factory(string $elementName, Framework $framework, FrameworkComposer $composer = null): Element
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
        return new $class($framework, $composer);
    }
}
