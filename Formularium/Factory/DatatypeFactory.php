<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\Formularium;
use Formularium\Datatype;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;
use Nette\PhpGenerator\PhpNamespace;
use ReflectionClass;

final class DatatypeFactory extends AbstractFactory
{
    use RegisteredFactoryTrait;

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    public static function getClassName(string $name): string
    {
        return "Datatype_$name";
    }

    public static function getSubNamespace(): string
    {
        return "Datatype";
    }

    protected static function getNamePair(\ReflectionClass $reflection): array
    {
        $class = $reflection->getName();

        /**
         * @var Datatype $d
         */
        $d = new $class(); // TODO: factory would be better

        return [
            'name' => $class,
            'value' => $d->getName()
        ];
    }

    public static function isValidClass(\ReflectionClass $reflection): bool
    {
        return $reflection->isSubclassOf(Datatype::class);
    }

    /**
     * Factory.
     *
     * @param string $name
     * @return Datatype
     * @throws ClassNotFoundException
     */
    public static function factory(string $name): Datatype
    {
        if (mb_strpos($name, '\\')) {
            try {
                return new $name();
            } catch (ClassNotFoundException $e) {
                // pass
            }
        }

        try {
            $className = static::class($name);
            return new $className();
        } catch (ClassNotFoundException $e) {
            // pass
        }

        // external factories
        foreach (static::$factories as $f) {
            try {
                return $f($name);
            } catch (ClassNotFoundException $e) {
                continue;
            }
        }
        $subns = static::getSubNamespace();
        throw new ClassNotFoundException("Invalid factory for $subns: $name");
    }

    /**
     * Generates scaffolding, with a child class for Datatype and a test case.
     *
     * @codeCoverageIgnore
     * @param string $datatypeName The new datatype name.
     * @param string $basetype The base type, if any.
     * @param string $namespace The namespace for the new file.
     * @param string $testNamespace The namespace for the test file.
     * @param callable $classCallback if present, called with the Nette\PhpGenerator\ClassType
     * to customize the class
     * @return array ['code' => code string, 'test' => test case string]
     */
    public static function generate(
        string $datatypeName,
        string $basetype = null,
        string $namespace = 'Formularium\\Datatype',
        string $testNamespace = 'Tests\\Unit',
        callable $classCallback = null
    ): array {
        $basetypeClass = $basetype ? '\\Formularium\\Datatype\\Datatype_' . $basetype : '\\Formularium\\Datatype';
        $basetype = $basetype ?? $datatypeName;

        $namespace = new PhpNamespace($namespace);
        $namespace->addUse('\\Formularium\\Model');
        $namespace->addUse('\\Formularium\\Exception\\ValidatorException');

        $class = $namespace->addClass("Datatype_${datatypeName}")
            ->setExtends($basetypeClass);

        $constructor = $class->addMethod('__construct')
            ->setBody("parent::__construct(\$typename, \$basetype);\n");
        $constructor->addParameter('typename', $datatypeName)->setType('string');
        $constructor->addParameter('basetype', $basetype)->setType('string');

        $class->addMethod('getRandom')
            ->setComment('
Returns a random valid value for this datatype, considering the validators

@param array \$validators
@throws Exception If cannot generate a random value.
@return mixed')
            ->setBody("throw new ValidatorException('Not implemented');")
            ->addParameter('validators', [])
            ->setType('array');

        $validateMethod = $class->addMethod('validate')
            ->setComment('
Checks if \$value is a valid value for this datatype considering the validators.

@param mixed \$value The value you are checking.
@param Model \$model The entire model, if your field depends on other things of the model. may be null.
@throws Exception If invalid, with the message.
@return mixed The validated value.')
             ->setBody("throw new ValidatorException('Not implemented');");

        $validateMethod->addParameter('value');
        $validateMethod->addParameter('model', null)
             ->setType('\Formularium\Model');

        if ($classCallback) {
            $classCallback($class);
        }

        $printer = new \Nette\PhpGenerator\PsrPrinter;
        $datatypeCode = "<?php declare(strict_types=1);\n" . $printer->printNamespace($namespace);

        $testCode = <<<EOF
<?php declare(strict_types=1);

namespace $testNamespace;

use Formularium\Datatype;
use Formularium\Factory\DatatypeFactory;
use FormulariumTests\Datatype\DatatypeBaseTestCase;

class ${datatypeName}Test extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): Datatype
    {
        return DatatypeFactory::factory('${datatypeName}');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => '', // TODO
                'expected' => '' // TODO
                // optional: 'validators' => []
            ]
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            [
                'value' => '', // TODO
                // optional: 'validators' => []
            ]
        ];
    }
}
EOF;
        return [
            'datatype' => $datatypeName,
            'code' => $datatypeCode,
            'test' => $testCode
        ];
    }

    /**
     * Generates scaffolding and saves it to a file
     *
     * @codeCoverageIgnore
     * @param array $codeData The data returned from self::generate()
     * @param string $path The
     * @return string[] With keys: 'code' and 'test', human messages of what was done, and
     * 'filename' and 'testfilename' with the paths.
     * @throws Exception If errors.
     */
    public static function generateFile(array $codeData, string $path, string $testpath = null): array
    {
        if (!is_dir($path)) {
            \Safe\mkdir($path, 0777, true);
        }

        $datatype = $codeData['datatype'];
        $retval = [];
        $filename = $retval['filename'] = $path . "/Datatype_{$datatype}.php";
        if (!file_exists($filename)) {
            $retval['code'] = "Created {$datatype} at {$filename}.";
            file_put_contents($filename, $codeData['code']);
        } else {
            $retval['code'] = "Filename $filename already exists.";
        }

        if ($testpath) {
            $testFilename = $retval['testfilename'] = $testpath . "/{$datatype}Test.php";
            if (!file_exists($testFilename)) {
                $retval['test'] = "Created ${datatype} test at {$testFilename}.";
                file_put_contents($testFilename, $codeData['test']);
            } else {
                $retval['test'] = "Filename test $testFilename already exists.";
            }
        }
        return $retval;
    }
}
