<?php declare(strict_types=1);

namespace Formularium\Factory;

trait NamespaceTrait
{
    /**
     * Namespaces to search
     *
     * @var string[]
     */
    protected static $baseNamespaces = [
        'Formularium'
    ];

    /**
     * @param string $ns The namespace to add
     * @return void
     * @codeCoverageIgnore
     */
    public static function appendBaseNamespace(string $ns): void
    {
        static::$baseNamespaces[] = $ns;
    }

    /**
     * @return string[]
     * @codeCoverageIgnore
     */
    public static function getBaseNamespaces(): array
    {
        return static::$baseNamespaces;
    }
}
