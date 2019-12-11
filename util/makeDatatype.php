<?php

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
$generateTest = $options['test'] ?? false;

if (!is_dir($path)) {
    echo "Path $path does not exist.\n";
    return 1;
}
if (file_exists($filename)) {
    echo "Filename $filename already exists.\n";
    return 1;
}

$datatypeCode = <<<EOF
<?php

namespace Formularium\Datatype;

use Formularium\Field;
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

    public function validate(\$value, Field \$f)
    {
        throw new ValidatorException('Not implemented');
    }
}
EOF;
file_put_contents($filename, $datatypeCode);

if ($generateTest) {
    $testFilename = "tests/Datatype/${datatype}Test.php";
    $testCode = <<<EOF
<?php

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
    file_put_contents($testFilename, $testCode);
}

echo "Created ${datatype}.\n";
