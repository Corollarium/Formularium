<?php declare(strict_types=1);

namespace Formularium\Factory;

trait RegisteredFactoryTrait
{
    /**
     * External factory functions.
     *
     * @var callable[]
     */
    protected static $factories = [];

    public static function registerFactory(callable $factory): void
    {
        static::$factories[] = $factory;
    }
}
