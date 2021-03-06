<?php declare(strict_types=1);

use Formularium\Factory\ValidatorFactory;

require('vendor/autoload.php');

$shortopts = "v:p::t::";
$longopts = array(
    "validator:",     // Required value
    "namespace::",
    "path::",
    "test-path::"
);
$options = getopt($shortopts, $longopts);
if (empty($options)) {
    echo "Syntax: --validator=xx [--namespace=xx] [--path=xx] [--test-path=xx]\n";
    return 1;
}

$validator = $options['validator'];
$namespace = $options['namespace'] ?? 'Formularium\\Validator';
$path = $options['path'] ?? "Formularium/Validator/" ;
$testpath = $options['testpath'] ?? "tests/Validator" ;

$code = ValidatorFactory::generate(
    $validator,
    $namespace
);
$retval = ValidatorFactory::generateFile(
    $code,
    $path,
    $testpath
);
echo $retval['code'] . "\n";
echo $retval['test'] . "\n";
