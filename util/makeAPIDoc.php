<?php declare(strict_types=1);

require('vendor/autoload.php');

use Formularium\Element;
use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\ValidatorFactory;
use Formularium\Formularium;
use HaydenPierce\ClassFinder\ClassFinder;

use function Safe\file_put_contents;

function validators()
{
    $validators = ValidatorFactory::getNames();

    $markdown = [];

    foreach ($validators as $className => $name) {
        $markdown[$name] = $className::getMetadata()->toMarkdown();
    }

    ksort($markdown);

    $validatorAPI = '
# Validators

List of validators and its parameters generated automatically.

' . join("\n", $markdown);

    file_put_contents(__DIR__ . '/../docs/api-validators.md', $validatorAPI);
}

function datatypes()
{
    $datatypes = DatatypeFactory::getNames();

    $markdown = [];
}

function elements()
{
    $frameworks = [
        'Bootstrap',
        'Buefy',
        'Bulma',
        'HTML',
        'Materialize'
    ];

    foreach ($frameworks as $framework) {
        $markdown = [];
        $ns = "Formularium\\Frontend\\$framework\\Element";

        /** @var array<class-string> $classesInNamespace */
        $classesInNamespace = ClassFinder::getClassesInNamespace($ns);

        foreach ($classesInNamespace as $className) {
            $reflection = new \ReflectionClass($className);
            if (!$reflection->isInstantiable()) {
                continue;
            }

            if (!is_a($className, Element::class, true)) {
                continue;
            }

            $metadata = $className::getMetadata();
            
            $markdown[$metadata->name] = $metadata->toMarkdown();
        }
        ksort($markdown);

        $elementAPI = "
# Elements for $framework

List of elements for $framework and its parameters.

" . join("\n", $markdown);
        
        file_put_contents(__DIR__ . "'/../docs/api-$framework-elements.md", $elementAPI);
    }
}

validators();
elements();
