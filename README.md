# Formularium

[![Build Status](https://travis-ci.com/Corollarium/Formularium.svg?branch=master)](https://travis-ci.com/Corollarium/Formularium)
[![Code Coverage](https://scrutinizer-ci.com/g/Corollarium/Formularium/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Corollarium/Formularium/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)
[![Total Downloads](https://img.shields.io/packagist/dt/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)
[![License](https://img.shields.io/packagist/l/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)

This is a general form generator and validator for PHP. It hosts a number of generators for different CSS and JS frameworks, as well as validators for backend and frontend. The main feature is that it provides high level data types, allowing you to specify exactly what you expect of each field in a unified way for datatype creation, validation and form generation. Your fields **are not strings**, stop treating them as such.

Forms are generated from a simple structure describing its fields, each one with a datatype and information for the HTML generator. Model descriptions can be serialized as JSON. It's easy to create new datatypes, either from zero or extending the base types provided. The generated HTML code can be used as is or manually customized for those pesky cases that no tool ever gets right.

If you are looking for [a backend scaffolding and validation, Modelarium](https://github.com/Corollarium/modelarium) is what you want.

Check the:

- [kitchen sink examples](https://corollarium.github.io/Formularium/kitchensink) and the
- [full documentation](https://corollarium.github.io/Formularium/)
- [sample Laravel app with Modelarium](https://github.com/Corollarium/modelarium-example)

## Why use this

- typed system: change the datatype and reflect it on your data.
- automatic validation: validate your data automatically and safely.
- component validators: add new validators for your datatypes easily.
- Fraphql: declare your models in Graphql SDL and get the scaffolding for free. Even better with [Modelarium](https://github.com/Corollarium/modelarium).
- generate frontend scaffolding: stop writing verbose HTML and code to generate code/cards/etc. Let this tool do all the basic work for you.
- SQL/Laravel typing: convert datatypes to your database generation with SQL and Laravel types.

## Sponsors

[![Corollarium](https://formularium.github.com/logo-horizontal-400px.png)](https://corollarium.com)

## Minimum example

Everything in a glance:

```php
// set your framework composition statically.
// For example, this builds HTML using Bootstrap as CSS and the Vue framework.
FrameworkComposer::set(['HTML', 'Bootstrap', 'Vue']);

// build the model from data description. You can use a JSON file as well.
$modelData = [
    'name' => 'TestModel',
    'fields' => [
        'myString' => [
            'datatype' => 'string',
            'extensions' => [
                Renderable_string::MIN_LENGTH => 3,
                Renderable_string::MAX_LENGTH => 30,
                Renderable::LABEL => 'This is some string',
                Renderable::COMMENT => 'Some text explaining this field',
                Renderable::PLACEHOLDER => "Type here"
            ]
        ],
        'someInteger' => [
            'datatype' => 'integer',
            'validators' => [
                Datatype_integer::MIN => [
                    'value' => 4,
                ],
                Datatype_integer::MAX =>  => [
                    'value' => 30,
                ]
            ]
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
  - Pure HTML
- CSS Frameworks:
  - [Bulma](https://bulma.io)
  - [Bootstrap](https://getbootstrap.com/)
  - [Materialize](https://materializecss.com/)
  - [Buefy](https://buefy.github.io/)
- JS/PHP Frameworks:
  - [Vue](https://vuejs.org)
  - [React](https://reactjs.org)
  - [Laravel Blade](https://laravel.com)
- JS extensions
  - [Parsley](https://parsleyjs.org/)
  - [Quill editor](https://quilljs.com/)
