<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;
use Formularium\Exception\ValidatorException;

/**
 * Utility class to validate data in composition to the validation in
 * datatypes.
 */
final class Validator
{
    /**
     * Factory.
     *
     */
    public static function factory(string $validatorName): ValidatorInterface
    {
        $class = "\\Formularium\\Validator\\$validatorName";
        if (!class_exists($class)) {
            $class = $validatorName;
            if (!class_exists($class)) {
                throw new ClassNotFoundException("Invalid datatype validator $validatorName");
            }
        }
        return new $class();
    }


    public static function generate(string $name, string $namespace = '\\Formularium\\Datatype'): array
    {
        $validatorCode = <<<EOF
<?php declare(strict_types=1); 

namespace $namespace;

use Formularium\Model;
use Formularium\ValidatorArgs;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use Formularium\Exception\ValidatorException;

class ${name} implements ValidatorInterface
{
    /**
     * Checks if \$value is a valid value for this datatype considering the validators.
     *
     * @param mixed \$value
     * @param array \$validators
     * @param Model \$model The entire model, if you your field depends on other things of the model. may be null.
     * @throws ValidatorException If invalid, with the message.
     * @return mixed
     */
    public function validate(\$value, array \$validators = [], Model \$model = null) {
        throw new \Formularium\Exception\ValidatorException('Not implemented yet.');
    }

    /**
     * Documents this validator.
     *
     * @return ValidatorMetadata
     */
    public function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            '${name}',
            "", // TODO: add description
            [
                // TODO: add ValidatorArgs if any
            ]
        );
    }
}
EOF;
        
        $testCode = <<<EOF
<?php declare(strict_types=1); 

require_once('DatatypeBaseTestCase.php');

use Formularium\\Model;
use $namespace\\{$name};
use PHPUnit\\Framework\\TestCase;

class ${name}_TestCase extends TestCase
{

    public function testFilled()
    {
        \$validator = \\Formularium\\Validator::factory('$name');
        \$modelData = [
            'name' => 'TestModel',
            'fields' => [
                'someField' => [
                    'datatype' => 'string',
                    'validators' => [
                        $name::class => [ 
                            'value' => true
                        ],
                    ]
                ]
            ]
        ];
        \$model = Model::fromStruct(\$modelData);
        \$input = 'x'; // REPLACE THIS
        \$expected = 'x'; // REPLACE THIS
        \$v = \$validator->validate(
            \$input,
            \$model->getField('someString')->getValidatorOption($name::class),
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
     * @param array $codeData The data returned from self::generate()
     * @param string $path The path for the validator code file
     * @param string $testpath The path for the validator test file
     * @return string[] With two keys: 'code' and 'test', human messages of what was done.
     * @throws Exception If errors.
     */
    public static function generateFile(array $codeData, string $path, string $testpath = null): array
    {
        if (!is_dir($path)) {
            throw new Exception("Path $path does not exist.");
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
