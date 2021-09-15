<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\Datatype;
use Formularium\Datatype\Datatype_enum;
use Formularium\Exception\ClassNotFoundException;
use HaydenPierce\ClassFinder\ClassFinder;
use ReflectionClass;

final class DatatypeGeneratorFactory
{
    use NamespaceTrait;

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * Factory.
     *
     * @param string|Datatype $datatypeName
     * @param CodeGenerator $codeGenerator
     * @return DatatypeGenerator
     */
    public static function factory($datatypeName, CodeGenerator $codeGenerator): DatatypeGenerator
    {
        /**
         * @var Datatype $datatypeClass
         */
        $datatypeClass = null;
        $datatypeClassName = '';
        
        if (is_string($datatypeName)) {
            $datatypeClass = DatatypeFactory::factory($datatypeName);
            $datatypeClassName = 'DatatypeGenerator_' . $datatypeName;
        } elseif (is_a($datatypeName, Datatype::class)) {
            $datatypeClass = $datatypeName;
            $datatypeClassName = 'DatatypeGenerator_' . $datatypeClass->getName();
        } else {
            throw new ClassNotFoundException("Invalid datatypeName argument type for DatatypeGeneratorFactory");
        }

        $class = null;
        $namespaces = array_merge(static::$namespaces, ['Formularium\\CodeGenerator']);
        foreach ($namespaces as $ns) {
            $codeGeneratorClassname = $codeGenerator->getName();
            $class = "$ns\\$codeGeneratorClassname\\DatatypeGenerator\\$datatypeClassName";
            if (class_exists($class)) {
                break;
            }
        }

        if (!class_exists($class)) {
            // try the base datatype then
            $datatypeName = $datatypeClass->getBasetype();
            $datatypeClassName = 'DatatypeGenerator_' . $datatypeName;

            foreach ($namespaces as $ns) {
                $codeGeneratorClassname = $codeGenerator->getName();
                $class = "$ns\\$codeGeneratorClassname\\DatatypeGenerator\\$datatypeClassName";
                if (class_exists($class)) {
                    break;
                }
            }

            if (!class_exists($class)) {
                throw new ClassNotFoundException("Invalid DatatypeGenerator $datatypeClassName for {$codeGenerator->getName()}");
            }
        }

        return new $class($codeGenerator);
    }

    /**
     * Undocumented function
     *
     * @param CodeGenerator $codeGenerator
     * @return DatatypeGenerator[]
     */
    public static function factoryAll(CodeGenerator $codeGenerator): array
    {
        $reflection = new ReflectionClass($codeGenerator);
        $classes = ClassFinder::getClassesInNamespace($reflection->getNamespaceName());
        return array_map(
            function ($c) {
                return new $c();
            },
            $classes
        );
    }

    public static function getDatatypeName(DatatypeGenerator $dg): string
    {
        $className = get_class($dg);
        $datatypeName = mb_substr($className, mb_strrpos($className, '_') + 1);
        return $datatypeName;
    }
}
