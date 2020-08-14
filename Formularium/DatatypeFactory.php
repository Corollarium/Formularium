<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;

final class DatatypeFactory
{
    /**
     * External factories.
     *
     * @var array
     */
    private static $factories = [];

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * Factory.
     *
     * @param string $datatype
     * @return Datatype
     * @throws ClassNotFoundException
     */
    public static function factory(string $datatype): Datatype
    {
        foreach (Formularium::getDatatypeNamespaces() as $ns) {
            $class = $ns . "\\Datatype_$datatype";
            if (class_exists($class)) {
                return new $class();
            }
        }

        // base namespace
        if (class_exists("\\Datatype_$datatype")) {
            $class = "\\Datatype_$datatype";
            return new $class();
        }

        // external factories
        foreach (self::$factories as $f) {
            try {
                return $f($datatype);
            } catch (ClassNotFoundException $e) {
                continue;
            }
        }
        throw new ClassNotFoundException("Invalid datatype $datatype");
    }

    public static function registerFactory(callable $factory): void
    {
        self::$factories[] = $factory;
    }

    /**
     * Generates scaffolding, with a child class for Datatype and a test case.
     *
     * @codeCoverageIgnore
     * @param string $datatype The new datatype name.
     * @param string $basetype The base type, if any.
     * @param string $namespace The namespace for the new file.
     * @return array ['code' => code string, 'test' => test case string]
     */
    public static function generate(string $datatype, string $basetype = null, string $namespace = '\\Formularium\\Datatype'): array
    {
        $datatypeLower = mb_strtolower($datatype);
        $basetypeClass = $basetype ? '\\Formularium\\Datatype\\Datatype_' . $basetype : '\\Formularium\\Datatype';
        $basetype = $basetype ?? $datatypeLower;

        $datatypeCode = <<<EOF
<?php declare(strict_types=1); 

namespace $namespace;

use Formularium\Model;
use Formularium\Exception\ValidatorException;

class Datatype_${datatypeLower} extends ${basetypeClass}
{
    public function __construct(string \$typename = '${datatypeLower}', string \$basetype = '$basetype')
    {
        parent::__construct(\$typename, \$basetype);
    }

    /**
     * Returns a random valid value for this datatype, considering the validators
     *
     * @param array \$validators
     * @throws Exception If cannot generate a random value.
     * @return mixed
     */
    public function getRandom(array \$validators = [])
    {
        throw new ValidatorException('Not implemented');
    }

    /**
     * Checks if \$value is a valid value for this datatype considering the validators.
     *
     * @param mixed \$value The value you are checking.
     * @param Model \$model The entire model, if your field depends on other things of the model. may be null.
     * @throws Exception If invalid, with the message.
     * @return mixed The validated value.
     */
    public function validate(\$value, Model \$model = null)
    {
        throw new ValidatorException('Not implemented');
    }
}
EOF;
        
        $testCode = <<<EOF
<?php declare(strict_types=1); 

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class ${datatype}Test extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('${datatypeLower}');
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
            'datatype' => $datatype,
            'datatypeLower' => $datatypeLower,
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
     * @return string[] With two keys: 'code' and 'test', human messages of what was done.
     * @throws Exception If errors.
     */
    public static function generateFile(array $codeData, string $path, string $testpath = null): array
    {
        if (!is_dir($path)) {
            \Safe\mkdir($path);
        }
    
        $datatype = $codeData['datatype'];
        $retval = [];
        $filename =  $path . "/Datatype_{$codeData['datatypeLower']}.php";
        if (!file_exists($filename)) {
            $retval['code'] = "Created {$datatype} at {$filename}.";
            file_put_contents($filename, $codeData['code']);
        } else {
            $retval['code'] = "Filename $filename already exists.";
        }

        if ($testpath) {
            $testFilename = $testpath . "/{$datatype}Test.php";
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
