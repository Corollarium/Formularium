<?php

require(__DIR__ . '/../vendor/autoload.php');

use Formularium\Datatype\Datatype_integer;
use Formularium\Datatype\Datatype_string;
use Formularium\Field;
use Formularium\Framework;
use Formularium\FrameworkComposer;
use Formularium\Frontend\HTML\Renderable\Renderable_choice;
use Formularium\Frontend\HTML\Renderable\Renderable_number;
use Formularium\Frontend\HTML\Renderable\Renderable_string;
use Formularium\Model;
use Formularium\Renderable;

function kitchenSink($frameworkName)
{
    FrameworkComposer::set($frameworkName);
    $head = FrameworkComposer::htmlHead();
    $footer = FrameworkComposer::htmlFooter();

    /*
     * kitchen sink fields
     */
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
            return ($t !== 'number' && $t !== 'choice');
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

    /*
     * basic demo fiels
     */
    $basicFields = [
        'myString' => [
            'datatype' => 'string',
            'validators' => [
                Datatype_string::MIN_LENGTH => 3,
                Datatype_string::MAX_LENGTH => 30,
            ],
            'extensions' => [
                Renderable::LABEL => 'Type string',
                Renderable::COMMENT => 'Some text explaining this field',
                Renderable::PLACEHOLDER => "Type here",
                Renderable::SIZE => Renderable::SIZE_LARGE
            ],
        ],
        'myInteger' => [
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
        ],
        'countrycoderadio' => [
            'datatype' => 'countrycode',
            'extensions' => [
                Renderable_choice::FORMAT_CHOOSER => Renderable_choice::FORMAT_CHOOSER_RADIO,
                Renderable::LABEL => 'Country code - radio choice'
            ],
        ],
        'countrycodeselect' => [
            'datatype' => 'countrycode',
            'extensions' => [
                Renderable_choice::FORMAT_CHOOSER => Renderable_choice::FORMAT_CHOOSER_SELECT,
                Renderable::LABEL => 'Country code - select choice'
            ],
        ]
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
        $randomData[$f->getName()] = $f->getDatatype()->getRandom();
    }
    $modelViewable = $model->viewable($randomData);
    $modelEditable = $model->editable();

    $title = join('/', $frameworkName);
    $html = <<<EOF
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>{$title}</title>
    {$head}
    <style>
    h1.kitchen {
        font-size: 2.5rem;
    }
    h2.kitchen {
        font-size: 2.0rem;
    }
    h3.kitchen {
        font-size: 1.5rem;
    }
    h1.kitchen, h2.kitchen, h3.kitchen  {
        margin-bottom: .5rem;
        font-weight: 500;
        line-height: 1.2;
    }
    </style>
</head>
<body>
<div class='container'>
    <h1 class="kitchen">$title</h1>
    
    <section>
        <h2 class="kitchen">Basic demo</h2>
        <form>
            $basicDemoEditable
        </form>
    </section>

    <section>
        <h2 class="kitchen">Full kitchen sink</h2>

        <div>
            <h3 class="kitchen">Viewable</h3>

            $modelViewable
        </div>
        
        <div>
            <h3 class="kitchen">Editable</h3>
            
            <form>
                $modelEditable
                <button type="submit">Send</button>
            </form>
        </div>
    </section>
    <footer style="margin-top: 2em; font-size: small">
        Generated with <a href="https://github.com/Corollarium/Formularium/">Formularium</a>.
    </footer>
</div>
{$footer}
</body></html>
EOF;
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
    $index .= "<li><a href='{$name}.html'>" . join('+', $framework) . '</a></li>';
}
$index .= "</ul>
<footer>
    <a href='https://github.com/Corollarium/Formularium/'>Source code</a> and <a href='https://corollarium.github.io/Formularium/'>Documentation</a>
</footer>
</div>
</body></html>";
file_put_contents(__DIR__ . '/../docs/kitchensink/index.html', $index);
