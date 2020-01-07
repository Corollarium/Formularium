<?php declare(strict_types=1);

$shortopts  = "d:p::b::t";
$longopts  = array(
    "datatype:",     // Required value
    "basetype::",
    "path::",    // Optional value
    "test"
);
$options = getopt($shortopts, $longopts);
if (empty($options)) {
    echo "Syntax: --datatype=xx [--basetype=xx] [--path=xx]\n";
    return 1;
}

$datatype = $options['datatype'];
$datatypeLower = mb_strtolower($options['datatype']);
$basetype = $options['basetype'] ?? $datatypeLower;
$basetypeClass = (array_key_exists('basetype', $options) ? '\\Formularium\\Datatype\\Datatype_' . $basetype : '\\Formularium\\Datatype');
$path = $options['path'] ?? "Formularium/Datatype/" ;
$filename =  $path . "/Datatype_${datatypeLower}.php";
$generateTest = array_key_exists('test', $options);

if (!is_dir($path)) {
    echo "Path $path does not exist.\n";
    return 1;
}

$datatypeCode = <<<EOF
<?php declare(strict_types=1); 

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

class Datatype_${datatypeLower} extends ${basetypeClass}
{
    public function __construct(string \$typename = '${datatypeLower}', string \$basetype = '$basetype')
    {
        parent::__construct(\$typename, \$basetype);
    }

    public function getRandom(array \$params = [])
    {
        throw new ValidatorException('Not implemented');
    }

    public function validate(\$value, Field \$field, Model \$model = null)
    {
        throw new ValidatorException('Not implemented');
    }
}
EOF;
if (!file_exists($filename)) {
    echo "Created ${datatype} test.\n";
    file_put_contents($filename, $datatypeCode);
} else {
    echo "Filename $filename already exists.\n";
}

if ($generateTest) {
    $testFilename = "tests/Datatype/${datatype}Test.php";
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
    if (!file_exists($testFilename)) {
        echo "Created ${datatype} test.\n";
        file_put_contents($testFilename, $testCode);
    } else {
        echo "Filename test $testFilename already exists.\n";
    }
}
