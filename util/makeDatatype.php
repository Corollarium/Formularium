<?php declare(strict_types=1);

use Formularium\Datatype;

$shortopts  = "d:p::b::t";
$longopts  = array(
    "datatype:",     // Required value
    "basetype::",
    "namespace::",
    "path::",    // Optional value
    "test"
);
$options = getopt($shortopts, $longopts);
if (empty($options)) {
    echo "Syntax: --datatype=xx [--basetype=xx] [--path=xx] [--test]\n";
    return 1;
}

$datatype = $options['datatype'];
$basetype = $options['basetype'] ?? $datatypeLower;
$namespace = $options['namespace'] ?? '';
$path = $options['path'] ?? "Formularium/Datatype/" ;
$filename =  $path . "/Datatype_${datatypeLower}.php";
$generateTest = array_key_exists('test', $options);

$code = Datatype::generate(
    $datatype,
    $basetype,
    $namespace
);
$retval = Datatype::generateFile(
    $code,
    $path,
);
