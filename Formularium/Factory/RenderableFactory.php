<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Datatype;
use Formularium\Framework;
use Formularium\Renderable;
use Formularium\Exception\ClassNotFoundException;

final class RenderableFactory
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
}
