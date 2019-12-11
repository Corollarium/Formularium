<?php

require(__DIR__ . '/../vendor/autoload.php');

use Formularium\Datatype\Datatype_integer;
use Formularium\Datatype\Datatype_string;
use Formularium\Framework;
use Formularium\FrameworkComposer;
use Formularium\Frontend\HTML\Renderable\Renderable_number;
use Formularium\Frontend\HTML\Renderable\Renderable_string;
use Formularium\Model;
use Formularium\Renderable;

function kitchenSink($frameworkName)
{
    FrameworkComposer::set($frameworkName);
    $head = FrameworkComposer::htmlHead();

    $html = "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    {$head}
</head>
<body>
<div class='container'>
    <h1>" . join('/', $frameworkName) . "</h1>";


    $fields = [];
    $datatypes = array_map(
        function ($x) {
            return str_replace('Datatype_', '', str_replace('.php', '', $x));
        },
        array_diff(scandir(__DIR__ . '/../Formularium/Datatype/'), array('.', '..'))
    );
    // TODO: avoid abstract classes
    $datatypes = array_filter(
        $datatypes,
        function ($t) {
            return ($t !== 'number');
        }
    );

    // make a default for all types
    foreach ($datatypes as $d) {
        $fields[$d] = [
            'datatype' => $d,
            'extensions' => [
                Renderable::LABEL => 'Type ' . $d
            ],
        ];
    }

    // improve a few:
    $fields['string'] = [
        'datatype' => 'string',
        'validators' => [
            Datatype_string::MIN_LENGTH => 3,
            Datatype_string::MAX_LENGTH => 30,
        ],
        'extensions' => [
            Renderable::LABEL => 'Type string',
            Renderable::COMMENT => 'Some text explaining this field',
            Renderable::PLACEHOLDER => "Type here"
        ],
    ];
    $fields['integer'] = [
        'datatype' => 'integer',
        'validators' => [
            Datatype_integer::MIN => 4,
            Datatype_integer::MAX => 30,
        ],
        'extensions' => [
            Renderable_number::STEP => 2,
            Renderable::LABEL => 'Type integer',
            Renderable::PLACEHOLDER => "Type here"
        ],
    ];

    $model = Model::fromStruct(
        [
            'name' => 'TestModel',
            'fields' => $fields
        ]
    );

    // TODO: values
    $html .= "<div><h2>Viewable</h2>\n";
    $html .= $model->viewable([]);
    $html .= "</div><div><h2>Editable</h2>\n";
    $html .= '<form>'; // TODO: parsley requires data-
    $html .= $model->editable();
    $html .= '<button type="submit">Send</button></form>';

    $html .= "</div></div>\n";
    $html .= FrameworkComposer::htmlFooter();
    $html .= "</body></html>";
    return $html;
}

@mkdir(__DIR__ . '/../docs/');
@mkdir(__DIR__ . '/../docs/kitchensink/');
$path = __DIR__ . '/../Formularium/Frontend/';
$dir = scandir($path);
if ($dir === false) {
    echo 'Cannot find frontend';
    return 1;
}
$frameworks = array_diff($dir, array('.', '..'));
$index = "<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Generator Kitchen Sink</h1>
<ul>";
$frameworks = [
    ['HTML'],
    ['HTML', 'Bulma'],
    ['HTML', 'Bootstrap'],
    ['HTML', 'Bootstrap', 'Parsley'],
    ['HTML', 'Materialize'],
    ['HTML', 'Bulma', 'Vue'],
    ['HTML', 'Buefy', 'Vue'],
    ['HTML', 'React'],
    ['HTML', 'Bootstrap', 'React'],
];
foreach ($frameworks as $framework) {
    $name = join('', $framework);
    echo "Building $name...\n";
    $html = kitchenSink($framework);
    file_put_contents(__DIR__ . '/../docs/kitchensink/' . $name . '.html', $html);
    $index .= "<li><a href='{$name}.html'>$name</a></li>";
}
$index .= "</ul></body></html>";
file_put_contents(__DIR__ . '/../docs/kitchensink/index.html', $index);
