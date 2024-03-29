<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\Datatype;
use Formularium\Datatype\Datatype_enum;
use Formularium\Exception\ClassNotFoundException;
use HaydenPierce\ClassFinder\ClassFinder;
use ReflectionClass;

final class DatatypeGeneratorFactory extends AbstractSpecializationFactory
{
    public static function getSubNamespace(): string
    {
        return "CodeGenerator";
    }

    public static function baseclassName(): string
    {
        return "DatatypeGenerator";
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
     * @param string|Datatype $datatypeName
     * @param CodeGenerator $codeGenerator
     * @param mixed $composer Not used here.
     * @return DatatypeGenerator
     */
    public static function specializedFactory($datatypeName, object $codeGenerator, $composer = null)
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
        $subns = static::getSubNamespace();
        foreach (static::getBaseNamespaces() as $ns) {
            $codeGeneratorClassname = $codeGenerator->getName();
            $class = "$ns\\$subns\\$codeGeneratorClassname\\DatatypeGenerator\\$datatypeClassName";
            if (class_exists($class)) {
                break;
            }
        }

        if (!class_exists($class)) {
            // try the base datatype then
            $datatypeName = $datatypeClass->getBasetype();
            $datatypeClassNameBase = 'DatatypeGenerator_' . $datatypeName;

            foreach (static::getBaseNamespaces() as $ns) {
                $codeGeneratorClassname = $codeGenerator->getName();
                $class = "$ns\\$subns\\$codeGeneratorClassname\\DatatypeGenerator\\$datatypeClassNameBase";
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

    public static function getDatatypeName(DatatypeGenerator $dg): string
    {
        $className = get_class($dg);
        $datatypeName = mb_substr($className, mb_strrpos($className, '_') + 1);
        return $datatypeName;
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
