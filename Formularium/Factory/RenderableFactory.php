<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Datatype;
use Formularium\Framework;
use Formularium\Renderable;
use Formularium\Exception\ClassNotFoundException;
use Formularium\FrameworkComposer;
use Formularium\HTMLNode;
use Nette\PhpGenerator\PhpNamespace;

final class RenderableFactory extends AbstractSpecializationFactory
{
    public static function getSubNamespace(): string
    {
        return 'Frontend';
    }

    public static function baseclassName(): string
    {
        return "Renderable";
    }

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
    public static function specializedFactory($datatype, object $framework, $composer = null): Renderable
    {
        if ($datatype instanceof Datatype) {
            $datatypeName = $datatype->getName();
        } else {
            $datatypeName = $datatype;
            $datatype = DatatypeFactory::factory($datatypeName);
        }

        $frameworkClassname = $framework->getName();
        $subNS = FrameworkFactory::getSubNamespace();
        foreach (static::getBaseNamespaces() as $ns) {
            $class = "$ns\\$subNS\\$frameworkClassname\\Renderable\\Renderable_$datatypeName";
            if (class_exists($class)) {
                return new $class($framework, $composer);
            }
            $basetype = $datatype->getBasetype();
            $class = "$ns\\$subNS\\$frameworkClassname\\Renderable\\Renderable_$basetype";
            if (class_exists($class)) {
                return new $class($framework, $composer);
            }
        }

        // external factories
        foreach (static::$factories as $f) {
            try {
                return $f($datatype, $framework, $composer);
            } catch (ClassNotFoundException $e) {
                continue;
            }
        }

        throw new ClassNotFoundException("Invalid renderable '$datatypeName' for {$framework->getName()}");
    }

    protected static function getNamePair(\ReflectionClass $reflection): array
    {
        $class = $reflection->getName();
        return [
            'name' => $class,
            'value' => $reflection->getShortName()
        ];
    }
}
