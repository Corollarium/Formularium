<?php declare(strict_types=1);

require('vendor/autoload.php');

$shortopts  = "d:b::n::p::t::";
$longopts  = array(
    "datatype:",     // Required value
    "basetype::",
    "namespace::",
    "path::",
    "test-path::"
);
$options = getopt($shortopts, $longopts);
if (empty($options)) {
    echo "Syntax: --datatype=xx [--namespace=xx] [--basetype=xx] [--path=xx] [--test]\n";
    return 1;
}

$datatype = $options['datatype'];
$basetype = $options['basetype'] ?? '';
$namespace = $options['namespace'] ?? 'Formularium\Datatype';
$path = $options['path'] ?? "Formularium/Datatype/" ;
$testpath = $options['testpath'] ?? "tests/Datatype" ;

$code = \Formularium\Datatype::generate(
    $datatype,
    $basetype,
    $namespace
);
$retval = \Formularium\Datatype::generateFile(
    $code,
    $path,
    $testpath
);
echo $retval['code'] . "\n";
echo $retval['test'] . "\n";
