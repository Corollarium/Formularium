<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Exception\ClassNotFoundException;
use HaydenPierce\ClassFinder\ClassFinder;

/**
 * Extends the Abstract Factory for base specialization classes, such as Framework.
 */
abstract class AbstractBaseSpecializationFactory extends AbstractFactory
{
    public static function class(string $name): string
    {
        $classname = static::getClassName($name);
        $subnsClassName = static::getSubNamespaceClassName();
        $subns = static::getSubNamespace();
        foreach (static::$baseNamespaces as $ns) {
            $class = "$ns\\$subns\\$classname\\$subnsClassName";
            if (class_exists($class)) {
                return $class;
            }
        }

        throw new ClassNotFoundException("Invalid class $name");
    }
}
