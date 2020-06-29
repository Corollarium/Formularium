<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;

/**
 * Abstract base class for all datatypes.
 */
abstract class Datatype
{
    use DatatypeRandomTrait;

    /**
     * Must be present in data, but may be empty.
     */
    public const REQUIRED = "required";

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $basetype;

    /**
     * Factory.
     *
     * @param string $datatype
     * @return Datatype
     */
    public static function factory(string $datatype): Datatype
    {
        $class = "\\Formularium\\Datatype\\Datatype_$datatype";
        if (!class_exists($class)) {
            $class = "\\Datatype_$datatype";
            if (!class_exists($class)) {
                $class = $datatype;
            }
            if (!class_exists($class)) {
                throw new ClassNotFoundException("Invalid datatype $datatype");
            }
        }
        return new $class();
    }

    protected function __construct(string $name = '', string $basetype = '')
    {
        $this->name = $name;
        $this->basetype = $basetype;
    }

    /**
     * Formats field to look prettier. Useful for formatting numbers with commas, ISO dates in
     * locale, etc.
     *
     * @param mixed $value
     * @param Field $field
     * @return mixed
     */
    public function format($value, Field $field)
    {
        return $value;
    }

    /**
     * Checks if $value is a valid value for this datatype considering the validators.
     *
     * @param mixed $value
     * @param array $validators The arguments for your validation.
     * @param Model $model The entire model, if your field depends on other things of the model. may be null.
     * @throws Exception If invalid, with the message.
     * @return mixed The validated value.
     */
    abstract public function validate($value, array $validators = [], ?Model $model = null);

    /**
     * Returns a random valid value for this datatype, considering the validators
     *
     * @param array $validators
     * @throws Exception If cannot generate a random value.
     * @return mixed
     */
    abstract public function getRandom(array $validators = []);

    /**
     * Returns a default value. Used to build new editable forms, for example.
     *
     * @return mixed
     */
    public function getDefault()
    {
        return '';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBasetype(): string
    {
        return $this->basetype;
    }

    public static function getValidatorMetadata(): array
    {
        return [
            self::REQUIRED => [
                'comment' => "Field is required.",
                'args' => []
            ]
        ];
    }

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
    public function getRandom(array \$validators = []);
    {
        throw new ValidatorException('Not implemented');
    }

    /**
     * Checks if \$value is a valid value for this datatype considering the validators.
     *
     * @param mixed \$value The value you are checking.
     * @param array \$validators The arguments for your validation.
     * @param Model \$model The entire model, if your field depends on other things of the model. may be null.
     * @throws Exception If invalid, with the message.
     * @return mixed The validated value.
     */
    public function validate(\$value, array \$validators = [], Model \$model = null)
    {
        throw new ValidatorException('Not implemented');
    }
}
EOF;
        
        $testCode = <<<EOF
<?php declare(strict_types=1); 

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class Datatype${datatype}_TestCase extends DatatypeBaseTestCase
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
     * @param array $codeData The data returned from self::generate()
     * @param string $path The
     * @return string[] With two keys: 'code' and 'test', human messages of what was done.
     * @throws Exception If errors.
     */
    public static function generateFile(array $codeData, string $path): array
    {
        if (!is_dir($path)) {
            throw new Exception("Path $path does not exist.");
            return 1;
        }
    
        $datatype = $codeData['datatype'];
        $retval = [];
        $filename =  $path . "/Datatype_{$codeData['datatypeLower']}.php";
        if (!file_exists($filename)) {
            $retval['code'] = "Created {$datatype}.";
            file_put_contents($filename, $codeData['code']);
        } else {
            $retval['code'] = "Filename $filename already exists.\n";
        }

        $testFilename = "tests/Datatype/{$datatype}Test.php";
        if (!file_exists($testFilename)) {
            $retval['test'] = "Created ${datatype} test.";
            file_put_contents($filename, $codeData['test']);
        } else {
            $retval['test'] = "Filename test $testFilename already exists.";
        }
        return $retval;
    }
}
