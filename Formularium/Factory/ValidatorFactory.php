<?php declare(strict_types=1);

namespace Formularium\Factory;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;
use Formularium\Exception\ValidatorException;
use Formularium\ValidatorInterface;
use Illuminate\Contracts\Validation\Validator;

/**
 * Utility class to validate data in composition to the validation in
 * datatypes.
 */
final class ValidatorFactory extends AbstractFactory
{
    protected static $namespaces = [
        'Formularium\\Validator'
    ];

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    public static function getClassName(string $name): string
    {
        return $name;
    }

    public static function isValidClass(\ReflectionClass $reflection): bool
    {
        return $reflection->implementsInterface(ValidatorInterface::class);
    }

    protected static function getNamePair(\ReflectionClass $reflection): array
    {
        return [
            'name' => $reflection->getName(),
            'object' => $reflection->getShortName()
        ];
    }

    /**
     * Factory.
     *
     * @param string $datatype
     * @return Validator
     * @throws ClassNotFoundException
     */
    public static function factory(string $datatype): Validator
    {
        return parent::factory($datatype);
    }

    /**
     * Generates a validator code file.
     *
     * @codeCoverageIgnore
     * @param string $name
     * @param string $namespace
     * @return array
     */
    public static function generate(string $name, string $namespace = '\\Formularium\\Validator'): array
    {
        $validatorCode = <<<EOF
<?php declare(strict_types=1); 

namespace $namespace;

use Formularium\Datatype;
use Formularium\Model;
use Formularium\MetadataParameter;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\Exception\ValidatorException;

class ${name} implements ValidatorInterface
{
    /**
     * Checks if \$value is a valid value for this datatype considering the validators.
     *
     * @param mixed \$value
     * @param array \$options The options passed to the validator
     * @param Datatype \$datatype The datatype being validator.
     * @param Model \$model The entire model, if you your field depends on other things of the model. may be null.
     * @throws ValidatorException If invalid, with the message.
     * @return mixed
     */
    public static function validate(\$value, array \$options = [], Datatype \$datatype, ?Model \$model = null)
    {
        throw new ValidatorException('Not implemented yet.');
        // return \$value;
    }

    /**
     * Documents this validator.
     *
     * @return Metadata
     */
    public static function getMetadata(): Metadata
    {
        return new Metadata(
            '${name}',
            "", // TODO: add description
            [
                // TODO: new MetadataParameter(...)
            ]
        );
    }
}
EOF;
        
        $testCode = <<<EOF
<?php declare(strict_types=1); 

namespace FormulariumTests\Validator;

use Formularium\\Model;
use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\ValidatorFactory;
use $namespace\\{$name};
use PHPUnit\\Framework\\TestCase;

class ${name}Test extends TestCase
{

    public function testFilled()
    {
        \$modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someField' => [
                    'datatype' => 'string',
                    'validators' => [
                        $name::class => [
                            'value' => true // REPLACE THIS
                        ],
                    ]
                ]
            ]
        ];
        \$model = Model::fromStruct(\$modelData);
        \$expected = 'x'; // REPLACE THIS
        \$v = ValidatorFactory::class('$name')::validate(
            \$expected,
            \$model->getField('someField')->getValidator($name::class),
            \$model
        );
        \$this->assertEquals(\$expected, \$v);
    }
}
EOF;
        return [
            'validator' => $name,
            'code' => $validatorCode,
            'test' => $testCode
        ];
    }

    /**
     * Generates scaffolding and saves it to a file
     *
     * @codeCoverageIgnore
     * @param array $codeData The data returned from self::generate()
     * @param string $path The path for the validator code file
     * @param string $testpath The path for the validator test file
     * @return string[] With two keys: 'code' and 'test', human messages of what was done.
     * @throws Exception If errors.
     */
    public static function generateFile(array $codeData, string $path, string $testpath = null): array
    {
        if (!is_dir($path)) {
            \Safe\mkdir($path);
        }

        $name = $codeData['validator'];
        $retval = [];
        $filename =  $path . "/{$name}.php";
        if (!file_exists($filename)) {
            $retval['code'] = "Created validator {$name}.";
            file_put_contents($filename, $codeData['code']);
        } else {
            $retval['code'] = "Filename $filename already exists.\n";
        }

        if ($testpath) {
            $testFilename = $testpath . "/{$name}Test.php";
            if (!file_exists($testFilename)) {
                $retval['test'] = "Created validator ${name} test.";
                file_put_contents($testFilename, $codeData['test']);
            } else {
                $retval['test'] = "Filename test $testFilename already exists.";
            }
        }
        return $retval;
    }
}
