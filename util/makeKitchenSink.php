<?php declare(strict_types=1);

require(__DIR__ . '/../vendor/autoload.php');

use Formularium\Datatype;
use Formularium\Factory\DatatypeFactory;
use Formularium\Element;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Formularium;
use Formularium\Framework;
use Formularium\FrameworkComposer;
use Formularium\Frontend\HTML\Element\Button;
use Formularium\Frontend\HTML\Element\Card;
use Formularium\Frontend\HTML\Element\Pagination;
use Formularium\Frontend\HTML\Element\Table;
use Formularium\Frontend\HTML\Renderable\Renderable_enum;
use Formularium\Frontend\HTML\Renderable\Renderable_number;
use Formularium\Model;
use Formularium\Renderable;
use Formularium\Validator\Max;
use Formularium\Validator\MaxLength;
use Formularium\Validator\Min;
use Formularium\Validator\MinLength;

function templatify(FrameworkComposer $frameworkComposer, string $templateName, string $contents, string $title)
{
    $head = $frameworkComposer->htmlHead();
    $footer = $frameworkComposer->htmlFooter();

    $frameworkNames = join(
        '/',
        array_map(
            function (Framework $f) {
                return $f->getName();
            },
            $frameworkComposer->getFrameworks()
        )
    );
    $template = file_get_contents(__DIR__ . '/kitchentemplates/' . $templateName);

    $template = strtr(
        $template,
        [
            '{{frameworkNames}}' => $frameworkNames,
            '{{title}}' => $title,
            '{{head}}' => $head,
            '{{contents}}' => $contents,
            '{{footer}}' => $footer,
        ]
    );
    return $template;
}

function generateBase(array $frameworkNames, string $templateName)
{
    $frameworkComposer = FrameworkComposer::create($frameworkNames);

    /*
     * basic demo fiels
     */
    $basicFields = [
        'myString' => [
            'datatype' => 'string',
            'validators' => [
                MinLength::class => [ 'value' => 3 ],
                MaxLength::class => [ 'value' => 30 ],
                Datatype::REQUIRED => [ 'value' => true ],
            ],
            'renderable' => [
                Renderable::LABEL => 'Type string',
                Renderable::COMMENT => 'Some text explaining this field. Must be between 3 and 30 characters.',
                Renderable::PLACEHOLDER => "Type here",
                Renderable::SIZE => Renderable::SIZE_LARGE,
                Renderable::ICON_PACK => 'fas',
                Renderable::ICON => 'fa-check',
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
                Renderable::LABEL => 'Type integer (between 4 and 40)',
                Renderable::PLACEHOLDER => "Type here"
            ],
        ],
        'ipv4example' => [
            'datatype' => 'ipv4',
            'renderable' => [
                Renderable::LABEL => 'An IP, such as 192.168.0.1'
            ],
        ],
        'countrycodeselect' => [
            'datatype' => 'countrycodeiso3',
            'renderable' => [
                Renderable_enum::FORMAT_CHOOSER => Renderable_enum::FORMAT_CHOOSER_SELECT,
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
    $submitButton = $frameworkComposer->element(
        'Button',
        [
            Element::LABEL => 'Save',
            Button::COLOR => Button::COLOR_PRIMARY,
            Button::TYPE => 'submit'
        ]
    );

    $basicDemoEditable = $basicModel->editable($frameworkComposer, []);
    return templatify($frameworkComposer, $templateName, $basicDemoEditable . $submitButton, 'Basic demo');
}

function generateElements(array $frameworkNames, string $templateName)
{
    $frameworkComposer = FrameworkComposer::create($frameworkNames);
    $upload = $frameworkComposer->element(
        'Upload',
        [
        ]
    );
    $submitButton = $frameworkComposer->element(
        'Button',
        [
            Element::LABEL => 'Save',
            Button::COLOR => Button::COLOR_PRIMARY,
            Button::TYPE => 'submit'
        ]
    );
    $table = $frameworkComposer->element(
        'Table',
        [
            Table::ROW_NAMES => ['First', 'Second', 'Third'],
            Table::ROW_DATA => [ ['a', 'b', 'c'], [ 'd', 'e', 'f'] ],
            Table::STRIPED => true
        ]
    );
    $pagination = $frameworkComposer->element(
        'Pagination',
        [
            Pagination::CURRENT => 21,
            Pagination::CURRENT_PAGE => 2, // should have only CURRENT or CURRENT_PAGE, but depends on framework
            Pagination::TOTAL_ITEMS => 253,
        ]
    );
    $card = $frameworkComposer->element(
        'Card',
        [
            Card::TITLE => 'Card title',
            Card::IMAGE => 'https://via.placeholder.com/150',
            Card::CONTENT => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '
        ]
    );
    $spinner = $frameworkComposer->element(
        'Spinner',
        [
        ]
    );

    $contents = '<h3 class="kitchen">Upload</h3>' . $upload . "\n" .
        '<h3 class="kitchen">Button</h3>' . $submitButton . "\n" .
        '<h3 class="kitchen">Table</h3>' .  $table . "\n" .
        '<h3 class="kitchen">Pagination</h3>' .  $pagination . "\n" .
        '<h3 class="kitchen">Card</h3><div style="width: 180px">' .  $card . "</div>\n" .
        '<h3 class="kitchen">Spinner</h3><div>'. $spinner . "</div>\n";

    return templatify($frameworkComposer, $templateName, $contents, 'Elements');
}

function kitchenSink(array $frameworks, string $templateName)
{
    $frameworkComposer = FrameworkComposer::create($frameworks);

    /*
     * kitchen sink fields
     */
    $fields = [];
    $datatypes = DatatypeFactory::getNames();

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
    $modelViewable = $model->viewable($frameworkComposer, $randomData);
    $modelEditable = $model->editable($frameworkComposer);

    return templatify($frameworkComposer, $templateName, $modelEditable, 'Model editable');
}

function main()
{
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
<h1>Formularium Examples</h1>
<p>These files are all automatically generated from the same data models, using different frameworks.</p>

<div>
EOF;
    $frameworks = [
        ['framework' => ['HTML', 'HTMLValidation', 'Quill'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Bulma', 'Quill'], 'template' => 'bulma'],
        ['framework' => ['HTML', 'HTMLValidation', 'Bootstrap', 'Quill'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Bootstrap', 'Quill', 'Parsley'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Bootstrap', 'Vue', 'Vuelidate'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Bootstrapvue', 'Vue'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Materialize'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Bulma', 'Quill', 'Vue'], 'template' => 'bulma'],
        ['framework' => ['HTML', 'HTMLValidation', 'Bootstrap', 'Vue'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Buefy', 'Vue'], 'template' => 'bulma'],
        ['framework' => ['HTML', 'HTMLValidation', 'React'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Bootstrap', 'React'], 'template' => 'base'],
        ['framework' => ['HTML', 'HTMLValidation', 'Vuetify', 'Vue'], 'template' => 'base'],
    ];
    foreach ($frameworks as $f) {
        $name = join('', $f['framework']);
        $prettyName = join(' + ', array_slice($f['framework'], 2));
        echo "Building $name...\n";
        
        $index .= "<h2>$prettyName</h2><ul>";

        $html = generateBase($f['framework'], $f['template'] . '_demo.html');
        $filename = __DIR__ . '/../docs/kitchensink/demo_' . $name . '.html';
        file_put_contents($filename, $html);
        $index .= "<li><a href='{$filename}'>Basic example</a></li>";

        $html = generateElements($f['framework'], $f['template'] . '_demo.html');
        $filename = __DIR__ . '/../docs/kitchensink/elements_' . $name . '.html';
        file_put_contents($filename, $html);
        $index .= "<li><a href='{$filename}'>Elements</a></li>";

        $html = kitchenSink($f['framework'], $f['template'] . '_demo.html');
        $filename = __DIR__ . '/../docs/kitchensink/editable_' . $name . '.html';
        file_put_contents($filename, $html);
        $index .= "<li><a href='{$filename}'>Editable (all types)</a></li>";

        // $html = kitchenSink($f['framework'], $f['template']);
        // file_put_contents(__DIR__ . '/../docs/kitchensink/' . $name . '.html', $html);

        $index .= "</ul>";
    }
    $index .= "</div>
<footer>
    <a href='https://github.com/Corollarium/Formularium/'>Source code</a> and <a href='https://corollarium.github.io/Formularium/'>Documentation</a>
</footer>
</div>
</body></html>";
    file_put_contents(__DIR__ . '/../docs/kitchensink/index.html', $index);
}

main();
