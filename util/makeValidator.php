<?php declare(strict_types=1);

$shortopts  = "v:p::t";
$longopts  = array(
    "validator:",     // Required value
    "path::",    // Optional value
    "test"
);
$options = getopt($shortopts, $longopts);
if (empty($options)) {
    echo "Syntax: --validator=xx [--path=xx] [--test]\n";
    return 1;
}

$validator = $options['validator'];
$validatorLower = mb_strtolower($options['validator']);
$basetype = $options['basetype'] ?? $validatorLower;
$path = $options['path'] ?? "Formularium/Validator/" ;
$filename =  $path . "/${validator}.php";
$generateTest = array_key_exists('test', $options);

if (!is_dir($path)) {
    echo "Path $path does not exist.\n";
    return 1;
}

$validatorCode = <<<EOF
<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\ValidatorInterface;

class $validator implements ValidatorInterface
{
    public function validate(\$value, Field \$field, Model \$model = null)
    {
        // TODO: throw new ValidatorException("Some error");
        return \$value;
    }
}
EOF;
if (!file_exists($filename)) {
    echo "Created ${validator} test.\n";
    file_put_contents($filename, $validatorCode);
} else {
    echo "Filename $filename already exists.\n";
}

if ($generateTest) {
    $testFilename = "tests/Validator/${validator}Test.php";
    $testCode = <<<EOF
<?php declare(strict_types=1); 

use Formularium\Validator;
use PHPUnit\Framework\TestCase;

class Validator${validator}Test extends TestCase
{

    public function test${validator}()
    {
        \$validator = \Formularium\Validator::factory('${validator}');
    }
}
EOF;
    if (!file_exists($testFilename)) {
        echo "Created ${validator} test.\n";
        file_put_contents($testFilename, $testCode);
    } else {
        echo "Filename test $testFilename already exists.\n";
    }
}
