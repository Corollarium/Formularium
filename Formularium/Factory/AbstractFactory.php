<?php declare(strict_types=1);

namespace Formularium\Factory;

use HaydenPierce\ClassFinder\ClassFinder;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;

abstract class AbstractFactory
{
    use NamespaceTrait;

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * Converts name to the class name
     *
     * @param string $name
     * @return string
     */
    public static function getClassName(string $name): string
    {
        return $name;
    }

    public static function class(string $name): string
    {
        $classname = static::getClassName($name);
        foreach (static::$namespaces as $ns) {
            $class = "$ns\\$classname";
            if (class_exists($class)) {
                return $class;
            }
        }

        // base namespace
        if (class_exists("\\$classname")) {
            $class = "\\$classname";
            return $class;
        }

        // TODO: registerFactory

        throw new ClassNotFoundException("Invalid class $name");
    }

    /**
     * Factory.
     *
     * @param string $name
     * @return Mixed
     * @throws ClassNotFoundException
     */
    public static function factory(string $name)
    {
        try {
            $className = static::class($name);
            return new $className();
        } catch (ClassNotFoundException $e) {
            // pass
        }

        // external factories
        foreach (static::$factories as $f) {
            try {
                return $f($name);
            } catch (ClassNotFoundException $e) {
                continue;
            }
        }
        throw new ClassNotFoundException("Invalid datatype $name");
    }
    
    /**
     * Checks if a class is valid for getNames()
     *
     * @param \ReflectionClass $reflection
     * @return boolean
     */
    public static function isValidClass(\ReflectionClass $reflection): bool
    {
        return true;
    }

    /**
     * Undocumented function
     *
     * @param \ReflectionClass $reflection
     * @return array ['name' => string, 'object' => Mixed ]
     */
    abstract protected static function getNamePair(\ReflectionClass $reflection): array;

    /**
     * Returns a list class name => object.
     *
     * @return array<string, string>
     */
    public static function getNames(): array
    {
        $classes = [];

        foreach (static::$namespaces as $namespace) {
            /** @var array<class-string> $classesInNamespace */
            $classesInNamespace = ClassFinder::getClassesInNamespace($namespace);

            foreach ($classesInNamespace as $class) {
                $reflection = new \ReflectionClass($class);
                if (!$reflection->isInstantiable()) {
                    continue;
                }

                if (!static::isValidClass($reflection)) {
                    continue;
                }

                $pair = static::getNamePair($reflection);
                $classes[(string)$pair['name']] = $pair['object'];
            }
        }

        return $classes;
    }
}
