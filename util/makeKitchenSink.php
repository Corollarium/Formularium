<?php declare(strict_types=1);

require(__DIR__ . '/../vendor/autoload.php');

use Formularium\Factory\DatatypeFactory;
use Formularium\Element;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Formularium;
use Formularium\FrameworkComposer;
use Formularium\Frontend\HTML\Element\Button;
use Formularium\Frontend\HTML\Element\Card;
use Formularium\Frontend\HTML\Element\Pagination;
use Formularium\Frontend\HTML\Element\Table;
use Formularium\Frontend\HTML\Renderable\Renderable_choice;
use Formularium\Frontend\HTML\Renderable\Renderable_number;
use Formularium\Model;
use Formularium\Renderable;
use Formularium\Validator\MaxLength;
use Formularium\Validator\Min;
use Formularium\Validator\MinLength;

function elements(FrameworkComposer $framework): string
{
    $upload = $framework->element(
        'Upload',
        [
        ]
    );
    $submitButton = $framework->element(
        'Button',
        [
            Element::LABEL => 'Save',
            Button::COLOR => Button::COLOR_PRIMARY
        ]
    );
    $table = $framework->element(
        'Table',
        [
            Table::ROW_NAMES => ['First', 'Second', 'Third'],
            Table::ROW_DATA => [ ['a', 'b', 'c'], [ 'd', 'e', 'f'] ],
            Table::STRIPED => true
        ]
    );
    $pagination = $framework->element(
        'Pagination',
        [
            Pagination::CURRENT => 21,
            Pagination::CURRENT_PAGE => 2, // should have only CURRENT or CURRENT_PAGE, but depends on framework
            Pagination::TOTAL_ITEMS => 253,
        ]
    );
    $card = $framework->element(
        'Card',
        [
            Card::TITLE => 'Card title',
            Card::IMAGE => 'https://via.placeholder.com/150',
            Card::CONTENT => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '
        ]
    );

    return '<h3 class="kitchen">Upload</h3>' . $upload . "\n" .
        '<h3 class="kitchen">Button</h3>' . $submitButton . "\n" .
        '<h3 class="kitchen">Table</h3>' .  $table . "\n" .
        '<h3 class="kitchen">Pagination</h3>' .  $pagination . "\n" .
        '<h3 class="kitchen">Card</h3><div style="width: 180px">' .  $card . "</div>\n";
}

function kitchenSink($frameworkName, string $templateName)
{
    $framework = FrameworkComposer::create($frameworkName);
    $head = $framework->htmlHead();
    $footer = $framework->htmlFooter();

    /*
     * kitchen sink fields
     */
    $fields = [];
    $datatypes = Formularium::getDatatypeNames();

    // make a default for all types
    foreach ($datatypes as $d) {
        try {
            DatatypeFactory::factory($d);
            $fields[$d] = [
                'datatype' => $d,
                'renderable' => [
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
            'renderable' => [
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
            'renderable' => [
                Renderable_number::STEP => 2,
                Renderable::LABEL => 'Type integer',
                Renderable::PLACEHOLDER => "Type here"
            ],
        ],
        'countrycodeselect' => [
            'datatype' => 'countrycodeISO3',
            'renderable' => [
                Renderable_choice::FORMAT_CHOOSER => Renderable_choice::FORMAT_CHOOSER_SELECT,
                Renderable::LABEL => 'Country code - select choice'
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
    $basicDemoEditable = $basicModel->editable($framework, []);

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
    $modelViewable = $model->viewable($framework, $randomData);
    $modelEditable = $model->editable($framework);

    $title = join('/', $frameworkName);
    $template = file_get_contents(__DIR__ . '/kitchentemplates/' . $templateName);

    $template = strtr(
        $template,
        [
            '{{title}}' => $title,
            '{{head}}' => $head,
            '{{basicDemoEditable}}' => $basicDemoEditable,
            '{{elements}}' => elements($framework),
            '{{modelViewable}}' => $modelViewable,
            '{{modelEditable}}' => $modelEditable,
            '{{footer}}' => $footer,
        ]
    );
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
    ['framework' => ['HTML', 'Bootstrapvue', 'Vue'], 'template' => 'base.html'],
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
