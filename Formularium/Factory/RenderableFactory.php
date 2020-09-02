<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Datatype;
use Formularium\Framework;
use Formularium\Renderable;
use Formularium\Exception\ClassNotFoundException;

final class RenderableFactory extends AbstractRenderableFactory
{
    protected static $namespaces = [
        'Formularium\\Frontend',
    ];

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

        $frameworkClassname = $framework->getName();
        foreach (static::$namespaces as $ns) {
            $class = "$ns\\$frameworkClassname\\Renderable\\Renderable_$datatypeName";
            if (class_exists($class)) {
                return new $class($framework);
            }
            $basetype = $datatype->getBasetype();
            $class = "$ns\\$frameworkClassname\\Renderable\\Renderable_$basetype";
            if (class_exists($class)) {
                return new $class($framework);
            }
        }

        // external factories
        foreach (static::$factories as $f) {
            try {
                return $f($datatype, $framework);
            } catch (ClassNotFoundException $e) {
                continue;
            }
        }

        // TODO: namespaces
        throw new ClassNotFoundException("Invalid datatype '$datatypeName' for {$framework->getName()}");
    }
}
