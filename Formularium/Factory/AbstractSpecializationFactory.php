<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\CodeGenerator\CodeGenerator;
use HaydenPierce\ClassFinder\ClassFinder;

/**
 * Extends the Abstract Factory for specialization classes, such as Element or Renderable,
 * that are children of a BaseSpecialization (e.g. "Framework")
 */
abstract class AbstractSpecializationFactory extends AbstractFactory
{
    /**
     * The base classe name, which is prepended, like 'DatatypeGenerator'
     *
     * @return string
     */
    abstract public static function baseclassName(): string;

    /**
     * @param mixed $datatypeName
     * @param object $baseSpecialization
     * @param object $composer
     * @return mixed
     */
    abstract public static function specializedFactory($datatypeName, object $baseSpecialization, object $composer = null);

    /**
     * @param CodeGenerator $codeGenerator
     * @return array
     */
    public static function specializedFactoryAll(CodeGenerator $codeGenerator): array
    {
        $subns = static::getSubNamespace();
        $codeGeneratorClassname = $codeGenerator->getName();
        $objects = [];
        foreach (static::getBaseNamespaces() as $ns) {
            $dgNS = "$ns\\$subns\\$codeGeneratorClassname\\" . static::baseclassName();
            $classes = ClassFinder::getClassesInNamespace($dgNS);
            $objects = array_merge(
                $objects,
                array_map(
                    function ($c) {
                        try {
                            return new $c();
                        } catch (\Throwable $e) {
                            return null;
                        }
                    },
                    $classes
                )
            );
        }
        return array_filter($objects);
    }
}
