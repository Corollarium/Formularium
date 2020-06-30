<?php declare(strict_types=1);

require(__DIR__ . '/../vendor/autoload.php');

use Formularium\Datatype;
use Formularium\Datatype\Datatype_integer;
use Formularium\Datatype\Datatype_string;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Formularium;
use Formularium\FrameworkComposer;
use Formularium\Frontend\HTML\Renderable\Renderable_choice;
use Formularium\Frontend\HTML\Renderable\Renderable_number;
use Formularium\Frontend\HTML\Renderable\Renderable_pagination;
use Formularium\Model;
use Formularium\Renderable;
use Formularium\Validator\MaxLength;
use Formularium\Validator\Min;
use Formularium\Validator\MinLength;
use Symfony\Component\ErrorHandler\Error\ClassNotFoundError;

function kitchenSink($frameworkName, string $templateName)
{
    FrameworkComposer::set($frameworkName);
    $head = FrameworkComposer::htmlHead();
    $footer = FrameworkComposer::htmlFooter();

    /*
     * kitchen sink fields
     */
    $fields = [];
    $datatypes = Formularium::getDatatypeNames();

    // make a default for all types
    foreach ($datatypes as $d) {
        try {
            Datatype::factory($d);
            $fields[$d] = [
                'datatype' => $d,
                'extensions' => [
                    Renderable::LABEL => 'Type ' . $d
                ],
            ];
        } catch (ClassNotFoundException $e) {
            // Abstract class
        }
    }

    /*
     * basic demo fiels
     */
    $basicFields = [
        'myString' => [
            'datatype' => 'string',
            'validators' => [
                MinLength::class => [ 'value' => 3],
                MaxLength::class => [ 'value' => 30],
            ],
            'extensions' => [
                Renderable::LABEL => 'Type string',
                Renderable::COMMENT => 'Some text explaining this field',
                Renderable::PLACEHOLDER => "Type here",
                Renderable::SIZE => Renderable::SIZE_LARGE,
                Renderable::ICON_PACK => 'fas',
                Renderable::ICON => 'fa-check'
            ],
        ],
        'myInteger' => [
            'datatype' => 'integer',
            'validators' => [
                Min::class => [ 'value' => 4],
                Max::class => [ 'value' => 40],
            ],
            'extensions' => [
                Renderable_number::STEP => 2,
                Renderable::LABEL => 'Type integer',
                Renderable::PLACEHOLDER => "Type here"
            ],
        ],
        'countrycodeselect' => [
            'datatype' => 'countrycodeISO3',
            'extensions' => [
                Renderable_choice::FORMAT_CHOOSER => Renderable_choice::FORMAT_CHOOSER_SELECT,
                Renderable::LABEL => 'Country code - select choice'
            ],
        ],
        'paginator' => [
            'datatype' => 'pagination',
            'extensions' => [
                Renderable_pagination::CURRENT => 20,
                Renderable_pagination::TOTAL_ITEMS => 253,
            ],
        ],
    ];

    // generate basic model
    $basicModel = Model::fromStruct(
        [
            'name' => 'BasicModel',
            'fields' => $basicFields
        ]
    );
    $basicDemoEditable = $basicModel->editable();

    
    // generate kitchen sink model
    $model = Model::fromStruct(
        [
            'name' => 'TestModel',
            'fields' => $fields
        ]
    );
    $randomData = [];
    foreach ($model->getFields() as $f) {
        if ($f->getDatatype()->getBasetype() !== 'constant') {
            $randomData[$f->getName()] = $f->getDatatype()->getRandom();
        }
    }
    $modelViewable = $model->viewable($randomData);
    $modelEditable = $model->editable();

    $title = join('/', $frameworkName);
    $template = file_get_contents(__DIR__ . '/kitchentemplates/' . $templateName);

    $template = str_replace('{{title}}', $title, $template);
    $template = str_replace('{{head}}', $head, $template);
    $template = str_replace('{{basicDemoEditable}}', $basicDemoEditable, $template);
    $template = str_replace('{{modelViewable}}', $modelViewable, $template);
    $template = str_replace('{{modelEditable}}', $modelEditable, $template);
    $template = str_replace('{{footer}}', $footer, $template);
    return $template;
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
$index = <<<EOF
<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Formularium Kitchen Sink</title>
    <meta property="og:title" content="Formularium">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Form validation and generation for PHP with custom frontend generators">
    <meta property="og:description" content="Form validation and generation for PHP with custom frontend generators">
    <link rel="canonical" href="https://corollarium.github.io/Formularium/">
    <meta property="og:url" content="https://corollarium.github.io/Formularium/">
    <meta property="og:site_name" content="Formularium">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Formularium Kitchen Sink</h1>
<ul>
EOF;
$frameworks = [
    ['framework' => ['HTML', 'Quill'], 'template' => 'base.html'],
    ['framework' => ['HTML', 'Bulma', 'Quill'], 'template' => 'bulma.html'],
    ['framework' => ['HTML', 'Bootstrap', 'Quill'], 'template' => 'base.html'],
    ['framework' => ['HTML', 'Bootstrap', 'Quill', 'Parsley'], 'template' => 'base.html'],
    ['framework' => ['HTML', 'Materialize'], 'template' => 'base.html'],
    ['framework' => ['HTML', 'Bulma', 'Quill', 'Vue'], 'template' => 'bulma.html'],
    ['framework' => ['HTML', 'Bootstrap', 'Vue'], 'template' => 'base.html'],
    ['framework' => ['HTML', 'Buefy', 'Vue'], 'template' => 'bulma.html'],
    ['framework' => ['HTML', 'React'], 'template' => 'base.html'],
    ['framework' => ['HTML', 'Bootstrap', 'React'], 'template' => 'base.html'],
];
foreach ($frameworks as $f) {
    $name = join('', $f['framework']);
    echo "Building $name...\n";
    $html = kitchenSink($f['framework'], $f['template']);
    file_put_contents(__DIR__ . '/../docs/kitchensink/' . $name . '.html', $html);
    $index .= "<li><a href='{$name}.html'>" . join('+', $f['framework']) . '</a></li>';
}
$index .= "</ul>
<footer>
    <a href='https://github.com/Corollarium/Formularium/'>Source code</a> and <a href='https://corollarium.github.io/Formularium/'>Documentation</a>
</footer>
</div>
</body></html>";
file_put_contents(__DIR__ . '/../docs/kitchensink/index.html', $index);
