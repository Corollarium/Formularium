<?php declare(strict_types=1);

namespace Formularium\Factory;

use HaydenPierce\ClassFinder\ClassFinder;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;

abstract class AbstractFactory
{
    use NamespaceTrait;

    public static $specializations = [];

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * Returns a pair with the name and the instantiated object given the reflection class.
     * This adds some flexibility to parse class names or provide arguments.
     *
     * @param \ReflectionClass $reflection
     * @return array ['name' => string, 'object' => Mixed ]
     */
    abstract protected static function getNamePair(\ReflectionClass $reflection): array;

    /**
     * Returns the sub-namespace, that is, the sub-directory in the main namespace we'll
     * find the classes for this specific factory.
     * Example: "Datatype", for "\\Formularium\\Datatype"
     *
     * @return string
     */
    abstract public static function getSubNamespace(): string;

    /**
     * Returns the sub-namespace classname, that is, the sub-directory in the main namespace we'll
     * find the classes for this specific factory.
     * Example: "Framework", for "\\Formularium\\Frontend\\HTML"
     *
     * @return string
     */
    public static function getSubNamespaceClassName(): string
    {
        return static::getSubNamespace();
    }

    /**
     * Returns specializations, such as the framework names.
     *
     * @return string[]
     */
    public static function getSpecializations(): array
    {
        return static::$specializations;
    }

    public static function appendSpecialization(string $name)
    {
        static::$specializations[] = $name;
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

    /**
     * Converts a base name (such as "integer") to a class name.
     *
     * @param string $name
     * @return string
     */
    public static function class(string $name): string
    {
        $classname = static::getClassName($name);
        $subns = static::getSubNamespace();
        foreach (static::$baseNamespaces as $ns) {
            $class = "$ns\\$subns\\$classname";
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
     * @param string $name The name ("string") or its FQCN
     * @return Mixed
     * @throws ClassNotFoundException
     */
    public static function factory(string $name)
    {
        if (mb_strpos($name, '\\')) {
            try {
                return new $name();
            } catch (ClassNotFoundException $e) {
                // pass
            }
        }
    
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
        $subns = static::getSubNamespace();
        throw new ClassNotFoundException("Invalid factory for $subns: $name");
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
     * Returns a list class name => object.
     *
     * @return array<string, Mixed>
     */
    public static function getNames(): array
    {
        return static::map(
            function (\ReflectionClass $reflection) {
                return static::getNamePair($reflection);
            }
        );
    }
    
    /**
     * Runs a map function on the classes this factory handles.
     *
     * @param callable $c
     * @return array
     */
    public static function map(callable $c): array
    {
        $classes = [];
        $subns = static::getSubNamespace();
        $specializations = static::getSpecializations() ?: [""];

        foreach (static::getBaseNamespaces() as $namespace) {
            foreach ($specializations as $specialization) {
                $n = $namespace . ($subns ? '\\' . $subns : '') . ($specialization ? '\\' . $specialization : '');
                /** @var array<class-string> $classesInNamespace */
                $classesInNamespace = ClassFinder::getClassesInNamespace($n);

                foreach ($classesInNamespace as $class) {
                    $reflection = new \ReflectionClass($class);
                    if (!$reflection->isInstantiable()) {
                        continue;
                    }


                    if (!static::isValidClass($reflection)) {
                        continue;
                    }

                    $pair = $c($reflection);
                    $classes[(string)$pair['name']] = $pair['value'];
                }
            }
        }
        return $classes;
    }

    /**
     * Returns all frameworks.
     *
     * @return Mixed[]
     */
    public static function factoryAll(): array
    {
        $all = [];
        $subns = static::getSubNamespace();
        foreach (static::getBaseNamespaces() as $ns) {
            $base = $ns . $subns;
            $x = array_map(
                function ($f) use ($base) {
                    $fName = "$base\\$f\\CodeGenerator";
                    return new $fName();
                },
                self::getSpecializations()
            );
            $all = array_merge($all, $x);
        }
        return $all;
    }
}
