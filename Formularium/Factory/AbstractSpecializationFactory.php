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
     * @param object $baseSpecialization
     * @param object $composer
     * @return mixed
     */
    abstract public static function specializedFactory($datatypeName, object $baseSpecialization, object $composer = null);
}
