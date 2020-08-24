<?php declare(strict_types=1);

namespace Formularium\Factory;

use Illuminate\Support\Str;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Framework;

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
        'Formularium\\Frontend\\Materialize',
        'Formularium\\Frontend\\Parsley',
        'Formularium\\Frontend\\Quill',
        'Formularium\\Frontend\\React',
        'Formularium\\Frontend\\Vue',
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
            if (Str::endsWith($ns, $name)) {
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
            'object' => $d->getName()
        ];
    }

    /**
     * Factory.
     *
     * @param string $datatype
     * @return Framework
     * @throws ClassNotFoundException
     */
    public static function factory(string $datatype): Framework
    {
        return parent::factory($datatype);
    }
}
