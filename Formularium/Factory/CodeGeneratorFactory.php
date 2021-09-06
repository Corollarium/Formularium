<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Framework;
use Formularium\StringUtil;

final class CodeGeneratorFactory extends AbstractFactory
{
    protected static $namespaces = [
        'Formularium\\CodeGenerator\\Typescript'
    ];

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    public static function class(string $name): string
    {
        $classname = static::getClassName($name);
        foreach (static::$namespaces as $ns) {
            if (StringUtil::endsWith($ns, $name)) {
                return $ns . "\\CodeGenerator";
            }
        }

        // TODO: registerFactory

        throw new ClassNotFoundException("Invalid code generator $name");
    }

    public static function isValidClass(\ReflectionClass $reflection): bool
    {
        return $reflection->isSubclassOf(CodeGenerator::class);
    }
    
    protected static function getNamePair(\ReflectionClass $reflection): array
    {
        $class = $reflection->getName();

        /**
         * @var CodeGenerator $d
         */
        $d = new $class();

        return [
            'name' => $class,
            'value' => $d->getName()
        ];
    }

    /**
     * Factory.
     *
     * @param string $name
     * @return CodeGenerator
     * @throws ClassNotFoundException
     */
    public static function factory(string $name): CodeGenerator
    {
        return parent::factory($name);
    }

    /**
     * Returns all frameworks.
     *
     * @return CodeGenerator[]
     */
    public static function factoryAll(): array
    {
        return array_map(
            function ($f) {
                $fName = $f . '\\CodeGenerator';
                return new $fName();
            },
            self::$namespaces
        );
    }
}
