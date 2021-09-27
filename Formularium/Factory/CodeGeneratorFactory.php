<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Framework;
use Formularium\StringUtil;

final class CodeGeneratorFactory extends AbstractBaseSpecializationFactory
{
    public static function getSubNamespace(): string
    {
        return "CodeGenerator";
    }

    protected static function getSpecializations(): array
    {
        return [
            'GraphQL',
            'LaravelEloquent',
            'SQL',
            'Typescript'
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
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
        return parent::factoryAll();
    }
}
