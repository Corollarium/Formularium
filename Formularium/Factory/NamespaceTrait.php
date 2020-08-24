<?php declare(strict_types=1);

namespace Formularium\Factory;

trait NamespaceTrait
{
    /**
     * Namespaces to search
     *
     * @var string[]
     */
    protected static $namespaces = [];

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

    /**
     * @param string $ns The namespace to add
     * @return void
     * @codeCoverageIgnore
     */
    public static function appendNamespace(string $ns): void
    {
        static::$namespaces[] = $ns;
    }
}
