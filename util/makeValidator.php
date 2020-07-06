<?php declare(strict_types=1);

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
$namespace = $options['namespace'] ?? 'Formularium\Datatype';
$path = $options['path'] ?? "Formularium/Validator/" ;
$testpath = $options['testpath'] ?? "tests/Validator" ;

$code = \Formularium\ValidatorFactory::generate(
    $validator,
    $namespace
);
$retval = \Formularium\ValidatorFactory::generateFile(
    $code,
    $path,
    $testpath
);
echo $retval['code'] . "\n";
echo $retval['test'] . "\n";
