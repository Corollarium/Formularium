<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Framework;
use Formularium\StringUtil;

/**
 * Abstract base class for frameworks. Each framework should have a class inheriting
 * from this class.
 */
final class FrameworkFactory extends AbstractFactory
{
    protected static $namespaces = [
        'Formularium\\Frontend\\Blade',
        'Formularium\\Frontend\\Bootstrap',
        'Formularium\\Frontend\\Bootstrapvue',
        'Formularium\\Frontend\\Buefy',
        'Formularium\\Frontend\\Bulma',
        'Formularium\\Frontend\\HTML',
        'Formularium\\Frontend\\HTMLValidation',
        'Formularium\\Frontend\\Materialize',
        'Formularium\\Frontend\\Parsley',
        'Formularium\\Frontend\\Quill',
        'Formularium\\Frontend\\React',
        'Formularium\\Frontend\\VeeValidate',
        'Formularium\\Frontend\\Vue',
        'Formularium\\Frontend\\Vuelidate',
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
                return $ns . "\\Framework";
            }
        }

        // TODO: registerFactory

        throw new ClassNotFoundException("Invalid framework $name");
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
        return array_map(
            function ($f) {
                $fName = $f . '\\Framework';
                return new $fName();
            },
            self::$namespaces
        );
    }
}
