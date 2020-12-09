# Formularium

[![Build Status](https://github.com/Corollarium/Formularium/workflows/build/badge.svg)](https://github.com/Corollarium/Formularium/actions?query=workflow%3Abuild)
[![Code Coverage](https://scrutinizer-ci.com/g/Corollarium/Formularium/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Corollarium/Formularium/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)
[![Total Downloads](https://img.shields.io/packagist/dt/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)
[![License](https://img.shields.io/packagist/l/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)

This is a general HTML form/element generator and validator for PHP. It hosts a number of generators for different CSS and JS frameworks, as well as validators for backend and frontend, abstracting code.

Formularium provides [high level data types](https://corollarium.github.io/Formularium/api-datatypes.html), allowing you to specify exactly what you expect of each field in a unified way for datatype creation, validation and form generation. Your fields **are not strings**, stop treating them as such.

Examples of the same PHP code generating frontends in Bootstrap, Bulma, Materialize and Buefy. Click on the images to see a live HTML.

<a href="https://corollarium.github.io/Formularium/kitchensink/HTMLHTMLValidationBootstrapQuill.html"><img src="https://corollarium.github.io/Formularium/shots/HTMLBootstrapQuill.png" width="400" height="616"></a>
<a href="https://corollarium.github.io/Formularium/kitchensink/HTMLHTMLValidationBulmaQuill.html"><img src="https://corollarium.github.io/Formularium/shots/HTMLBulmaQuill.png" width="400" height="616"></a>
<a href="https://corollarium.github.io/Formularium/kitchensink/HTMLHTMLValidationMaterialize.html"><img src="https://corollarium.github.io/Formularium/shots/HTMLMaterialize.png" width="400"  height="616"></a>
<a href="https://corollarium.github.io/Formularium/kitchensink/HTMLHTMLValidationBootstrapVue.html"><img src="https://corollarium.github.io/Formularium/shots/HTMLBuefyVue.png" width="400" height="616"></a>

Forms are generated from a simple structure describing its fields, each one with a datatype and information for the HTML generator. Model descriptions can be serialized as JSON. It's easy to create new datatypes, either from zero or extending the base types provided. The generated HTML code can be used as is or manually customized for those pesky cases that no tool ever gets right.

If you are looking for [a fully integrated backend/frontend scaffolding and validation, Modelarium](https://github.com/Corollarium/modelarium) is what you want. Formularium is the low-level generator used by Modelarium.

## Getting started

Check the:

- [kitchen sink examples](https://corollarium.github.io/Formularium/kitchensink)
- [full documentation](https://corollarium.github.io/Formularium/)
- [a basic hello world example in pure PHP](https://github.com/Corollarium/Formularium-example)
- [Modelarium, a full backend/frontend scaffolding generator for PHP/Laravel](https://github.com/Corollarium/modelarium/)
- [sample Laravel app with Modelarium](https://github.com/Corollarium/modelarium-example)

## Why use this

- typed data system: change the datatype and reflect it on your data.
- automatic validation: validate your data automatically and safely.
- component validators: create new datatypes and add new validators easily.
- HTML abstraction: abstract your CSS frameworks for simple element generation from code, like buttons or tables.
- Graphql: declare your models in Graphql SDL and get the scaffolding for free. Works even better with [Modelarium](https://github.com/Corollarium/modelarium).
- quickly generate frontend scaffolding: stop writing verbose HTML and have manual labor to generate forms/cards/etc. Let this tool do all the basic work for you and just refine the design if necessary.
- component generation: generate React and Vue components with the corresponding HTML template.
- SQL/Graphql/JS/Laravel typing: convert datatypes to your database with SQL and Laravel types, or quickly generate Graphql and JS code.

## Sponsors

[![Corollarium](https://corollarium.github.io/Formularium/logo-horizontal-400px.png)](https://corollarium.com)

## Minimum example

Everything in a glance:

```php
// set your framework composition statically.
// For example, this builds HTML using Bootstrap as CSS and the Vue framework.
$composer = new FrameworkComposer(['HTML', 'Bootstrap', 'Vue']);

// you can just make simple elements, like a button
echo $composer->element(
    'Button',
    [
        Element::LABEL => 'Submit',
        Element::SIZE => Element::SIZE_LARGE,
    ]
);

// build the model from data description. You can use a JSON file as well or build it with constructors.
$modelData = [
    'name' => 'TestModel',
    'fields' => [
        'myString' => [
            'datatype' => 'string',
            'validators' => [
                \Formularium\Validator\MinLength::class => [
                    'value' => 5,
                ],
                \Formularium\Validator\MaxLength::class =>  => [
                    'value' => 30,
                ]
            ],
            'renderable' => [
                Renderable::LABEL => 'This is some string',
                Renderable::COMMENT => 'Some text explaining this field',
                Renderable::PLACEHOLDER => "Type here"
            ]
        ],
        'someInteger' => [
            'datatype' => 'integer',
            'validators' => [
                \Formularium\Validator\Min::class => [
                    'value' => 4,
                ],
                \Formularium\Validator\Max::class =>  => [
                    'value' => 40,
                ]
            ],
            'renderable' => [
                Renderable_number::STEP => 2,
                Renderable::LABEL => 'Some integer',
                Renderable::PLACEHOLDER => "Type here"
            ]
        ]
    ]
];
$model = Model::fromStruct($modelData);

// validate some data
$data = [
    'myString' => 'some string here',
    'someInteger' => 32
];
$validation = $model->validate($data);
if (!empty($validation['errors'])) {
    foreach ($validation['errors'] as $fieldName => $error) {
        echo "$fieldName has an error: $error\n";
    }
}
// get data after validation
$validated = $validation['validated'];

// render a form
echo $model->editable($data);

// render a view
echo $model->viewable($data);
```

The output is a nice HTML that you can use as basis for your forms. See the generated HTML on the [kitchen sink examples](https://corollarium.github.io/Formularium/kitchensink).

## Supported frontend generators

Formularium is built in a way that generators can be chained, so you can combine a basic HTML form generator, with a CSS framework and a JS validator, or possibly get the form into a Vue or React component. We provide a number of frontend plugins and you can easily extend with your own (and submit a PR!).

- Base generators:
  - HTML: Pure HTML
  - HTMLValidation: Form Validation in pure HTML (no js)
  - Future: Nativescript
  - Future: React Native
- CSS Frameworks:
  - [Bootstrap](https://getbootstrap.com/)
  - [Bulma](https://bulma.io)
  - [Materialize](https://materializecss.com/)
  - [Buefy](https://buefy.github.io/)
  - [Bootstrapvue](https://bootstrap-vue.org/)
- JS/PHP Frameworks:
  - [Vue](https://vuejs.org)
  - [React](https://reactjs.org)
  - [Laravel Blade](https://laravel.com)
  - Future: Angular
- JS extensions
  - [Parsley](https://parsleyjs.org/)
  - [Quill editor](https://quilljs.com/)
  - [Vuelidate](https://vuelidate.js.org/) partially implemented
  - [VeeValidate](https://logaretm.github.io/vee-validate/) partially implemented

## Contributing [![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/Corollarium/formularium/issues)

Any contributions are welcome. Please send a PR.

We are looking for people experienced in React and Angular to work on its generators.
