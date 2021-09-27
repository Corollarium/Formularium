<?php declare(strict_types=1);

namespace Formularium\Factory;

/**
 * Extends the Abstract Factory for specialization classes, such as Element or Renderable,
 * that are children of a BaseSpecialization (e.g. "Framework")
 */
abstract class AbstractSpecializationFactory extends AbstractFactory
{
    /**
     * @param mixed $datatypeName
     * @param mixed $baseSpecialization
     * @return mixed
     */
    abstract public static function specializedFactory($datatypeName, object $baseSpecialization, $composer = null);

    protected static function getNamePair(\ReflectionClass $reflection): array
    {
        $class = $reflection->getName();

        $d = new $class();

        return [
            'name' => $class,
            'value' => $d->getName()
        ];
    }
}
