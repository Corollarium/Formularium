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
use Formularium\Frontend\Vue\Framework as VueFramework;
use Formularium\HTMLNode;
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

function buildComposer(array $frameworkNames): FrameworkComposer
{
    $frameworkComposer = FrameworkComposer::create($frameworkNames);
    if ($frameworkComposer->getByName('Vuetify')) {
        /**
         * @var VueFramework
         */
        $vue = $frameworkComposer->getByName('Vue');
        $vue->getVueCode()
            ->appendOther('vuetify', 'new Vuetify()');
    }
    return $frameworkComposer;
}

function generateBase(array $frameworkNames, string $templateName)
{
    $frameworkComposer = buildComposer($frameworkNames);

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

    $submitButton = $frameworkComposer->nodeElement(
        'Button',
        [
            Element::LABEL => 'Save',
            Button::COLOR => Button::COLOR_PRIMARY,
            Button::TYPE => 'submit'
        ]
    );

    $frameworkComposer->appendFooterElement($submitButton);
    $basicDemoEditable = $basicModel->editable($frameworkComposer, []);
    return templatify($frameworkComposer, $templateName, $basicDemoEditable, 'Basic demo');
}

function generateElements(array $frameworkNames, string $templateName)
{
    $frameworkComposer = buildComposer($frameworkNames);

    $wrapNode = function (string $title, HTMLNode $node) use ($frameworkComposer) {
        $frameworkComposer->appendFooterElement(
            new HTMLNode(
                'section',
                [ "class" => "spaced" ],
                [new HTMLNode('h3', [], $title), $node ]
            )
        );
    };

    $upload = $frameworkComposer->nodeElement(
        'Upload',
        [
        ]
    );
    $wrapNode('Upload', $upload);

    $submitButton = $frameworkComposer->nodeElement(
        'Button',
        [
            Element::LABEL => 'Save',
            Button::COLOR => Button::COLOR_PRIMARY,
            Button::TYPE => 'submit'
        ]
    );
    $wrapNode('Button', $submitButton);

    $table = $frameworkComposer->nodeElement(
        'Table',
        [
            Table::ROW_NAMES => ['First', 'Second', 'Third'],
            Table::ROW_DATA => [ ['a', 'b', 'c'], [ 'd', 'e', 'f'] ],
            Table::STRIPED => true
        ]
    );
    $wrapNode('Table', $table);

    $pagination = $frameworkComposer->nodeElement(
        'Pagination',
        [
            Pagination::CURRENT => 21,
            Pagination::CURRENT_PAGE => 2, // should have only CURRENT or CURRENT_PAGE, but depends on framework
            Pagination::TOTAL_ITEMS => 203,
        ]
    );
    $wrapNode('Pagination', $pagination);

    $card = $frameworkComposer->nodeElement(
        'Card',
        [
            Card::TITLE => 'Card title',
            Card::IMAGE => 'https://via.placeholder.com/150',
            Card::CONTENT => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '
        ]
    );
    $wrapNode('Card', $card);

    $spinner = $frameworkComposer->nodeElement(
        'Spinner',
        [
        ]
    );
    $wrapNode('Spinner', $spinner);

    $basicModel = Model::fromStruct(
        [
            'name' => 'BasicModel',
            'fields' => []
        ]
    );

    $vue = $frameworkComposer->getByName('Vue');
    if ($vue) {
        /**
         * @var \Formularium\Frontend\Vue\Framework $vue
         */
        $vue->getVueCode()->appendExtraData('file', '');
        $vue->getVueCode()->appendExtraData('paginator', [ "currentPage" => 1, "totalItems" => 203 ]);
    }

    $html = $basicModel->editable($frameworkComposer, []);

    return templatify($frameworkComposer, $templateName, $html, 'Elements');
}

function kitchenSink(array $frameworkNames, string $templateName)
{
    $frameworkComposer = buildComposer($frameworkNames);

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

    return [
        templatify($frameworkComposer, $templateName, $modelViewable, 'Model Viewable'),
        templatify($frameworkComposer, $templateName, $modelEditable, 'Model editable')
    ];
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
        $index .= "<li><a href='{$filename}'>Basic elements</a></li>";

        $html = kitchenSink($f['framework'], $f['template'] . '_demo.html');
        $filename = __DIR__ . '/../docs/kitchensink/viewable_' . $name . '.html';
        file_put_contents($filename, $html[0]);
        $index .= "<li><a href='{$filename}'>Viewable (all data types)</a></li>";
        $filename = __DIR__ . '/../docs/kitchensink/editable_' . $name . '.html';
        file_put_contents($filename, $html[1]);
        $index .= "<li><a href='{$filename}'>Editable (all data types)</a></li>";

        // $html = kitchenSink($f['framework'], $f['template']);
        // file_put_contents(__DIR__ . '/../docs/kitchensink/' . $name . '.html', $html);

        $index .= "</ul>";
    }
    $index .= "</div>
<footer>
    <a href='https://github.com/Corollarium/Formularium/'>Formularium Source code</a> and <a href='https://corollarium.github.io/Formularium/'>Documentation</a>
</footer>
</div>
</body></html>";
    file_put_contents(__DIR__ . '/../docs/kitchensink/index.html', $index);
}

main();
