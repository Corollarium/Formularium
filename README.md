# Formularium

[![Build Status](https://travis-ci.com/Corollarium/Formularium.svg?branch=master)](https://travis-ci.com/Corollarium/Formularium)
[![Code Coverage](https://scrutinizer-ci.com/g/Corollarium/Formularium/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Corollarium/Formularium/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)
[![Total Downloads](https://img.shields.io/packagist/dt/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)
[![License](https://img.shields.io/packagist/l/corollarium/formularium.svg?style=flat-square)](https://packagist.org/packages/corollarium/formularium)

This is a general form generator and validator for PHP. It hosts a number of generators for different CSS and JS frameworks, as well as validators for backend and frontend. The main feature is that it provides high level data types, allowing you to specify exactly what you expect of each field in a unified way for validation and form generation. Your fields **are not strings**, stop treating them as such.

Forms are generated from a simple structure describing its fields, each one with a datatype and information for the HTML generator. Model descriptions can be serialized as JSON. It's easy to create new datatypes, either from zero or extending the base types provided. The generated HTML code can be used as is or manually customized for those pesky cases that no tool ever gets right.

Check the:
- [kitchen sink examples](https://corollarium.github.io/Formularium/kitchensink) and the 
- [documentation](https://corollarium.github.io/Formularium/)
- [sample php app](https://github.com/Corollarium/Formularium-example)

## Minimum example

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
            'extensions' => [
                Datatype_integer::MIN => 4,
                Datatype_integer::MAX => 30,
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
- JS Frameworks/validators:
    - [Vue](https://vuejs.org)
    - [React](https://reactjs.org)
    - [Parsley](https://parsleyjs.org/)
 