<?php declare(strict_types=1);

use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\FrameworkFactory;
use Formularium\Factory\ValidatorFactory;

require('vendor/autoload.php');

$shortopts = "v:p::t::";
$longopts = array(
    "renderable:",     // Required value
    "framework::",
    "namespace::",
    "path::",
);
$options = getopt($shortopts, $longopts);
if (empty($options)) {
    echo "Syntax: --renderable=xx [--framework=xx] [--namespace=xx] [--path=xx]\n";
    return 1;
}

$renderable = $options['renderable'];
$framework = $options['framework'] ?? '*';
$namespace = $options['namespace'] ?? 'Formularium\\Frontend';
$basePath = $options['path'] ?? "Formularium/Frontend/";

if ($framework === '*') {
    $frameworks = FrameworkFactory::factoryAll();
} else {
    $frameworks = [FrameworkFactory::factory($framework)];
}
$printer = new \Nette\PhpGenerator\PsrPrinter();
$datatype = DatatypeFactory::factory($renderable);
$datatypeLower = mb_strtolower($datatype->getName());

foreach ($frameworks as $framework) {
    /**
     * @var Framework $framework
     */
    $phpns = $framework->generateRenderable($datatype, $baseNamespace);
    $code = "<?php declare(strict_types=1);\n" . $printer->printNamespace($phpns);
    $basepath = $basePath . '/' . $framework->getName() . '/Renderable/';
    if (!is_dir($basepath)) {
        \Safe\mkdir($basepath, 0777, true);
    }

    $filename = $basepath . 'Renderable_' . $datatypeLower . '.php';
    if (!file_exists($filename)) {
        echo "Created renderable at {$filename}.";
        file_put_contents($filename, $code);
    } else {
        echo "Filename $filename already exists.";
    }
}
