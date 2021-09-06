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
        $datatypeClass = '';
        if (is_string($datatypeName)) {
            $datatypeClass = '';
        } elseif (is_a($datatypeName, Datatype::class)) {
            /**
             * @var Datatype $datatypeName
             */
            $datatypeClass = 'DatatypeGenerator_' . $datatypeName->getName();
        }

        // TODO: use reflection like Datatype
        $codeGeneratorClassname = get_class($codeGenerator);
        $lastpos = strrpos($codeGeneratorClassname, '\\');
        if ($lastpos === false) {
            $ns = '';
        } else {
            $ns = '\\' . substr($codeGeneratorClassname, 0, $lastpos);
        }
        $class = "$ns\\DatatypeGenerator\\$datatypeClass";
        if (!class_exists($class)) {
            // TODO: namespaces
            throw new ClassNotFoundException("Invalid DatatypeGenerator $datatypeClass for {$codeGenerator->getName()}");
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
