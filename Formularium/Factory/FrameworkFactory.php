<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Framework;

/**
 * Abstract base class for frameworks. Each framework should have a class inheriting
 * from this class.
 */
final class FrameworkFactory
{
    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    public static function factory(string $framework = ''): Framework
    {
        $class = "\\Formularium\\Frontend\\$framework\\Framework";
        if (!class_exists($class)) {
            throw new ClassNotFoundException("Invalid framework $framework");
        }
        return new $class();
    }
}
