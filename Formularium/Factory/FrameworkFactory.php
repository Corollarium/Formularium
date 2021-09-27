<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Framework;
use Formularium\StringUtil;

final class FrameworkFactory extends AbstractBaseSpecializationFactory
{
    public static $specializations = [
            'Blade',
            'Bootstrap',
            'Bootstrapvue',
            'Buefy',
            'Bulma',
            'HTML',
            'HTMLValidation',
            'Materialize',
            'Parsley',
            'Quill',
            'React',
            'VeeValidate',
            'Vue',
            'Vuelidate',
            'Vuetify',
    ];

    public static function getSubNamespace(): string
    {
        return "Frontend";
    }

    public static function getSubNamespaceClassName(): string
    {
        return "Framework";
    }

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    public static function isValidClass(\ReflectionClass $reflection): bool
    {
        return $reflection->isSubclassOf(Framework::class);
    }

    protected static function getNamePair(\ReflectionClass $reflection): array
    {
        $class = $reflection->getName();

        /**
         * @var Framework $d
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
     * @return Framework
     * @throws ClassNotFoundException
     */
    public static function factory(string $name): Framework
    {
        return parent::factory($name);
    }

    /**
     * Returns all frameworks.
     *
     * @return Framework[]
     */
    public static function factoryAll(): array
    {
        return parent::factoryAll();
    }
}
