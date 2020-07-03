# Formularium

This is an [open source general frontend generator and backend validator for PHP](https://github.com/Corollarium/Formularium/). It hosts a number of generators for different CSS frameworks, as well as validators. The main feature is that it provides high level data types, allowing you to specify exactly what you expect of each field in a unified way for validation and form generation. Your fields are not strings, stop treating them as such.

Forms are generated from a simple structure, which can be serialized as JSON. It's easy to create new datatypes, either from zero or extending the base types provided. The generated code can be used as is or customized with fine tuning for those pesky cases that no tool ever gets right.

Check:

- [kitchen sink demo](https://corollarium.github.io/Formularium/kitchensink)
- [a basic hello world example in pure PHP](https://github.com/Corollarium/Formularium-example)
- [Modelarium, a full backend/frontend scaffolding generator for PHP/Laravel](https://github.com/Corollarium/modelarium/).

## Documentation

- [getting started: how to declare your models](model.md)
- [base validators available for all datatypes](basevalidator.md)
- [base renderable available for all datatypes](baseextension.md)
- [how to create your own datatype](datatype.md)
- [how to add support to your own frontend framework](frontend.md)

## Getting started

Install with composer:

```
composer required Corollarium/Formularium
```

Here's a minimal sample:

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
            'validators' => [
                \Formularium\Validator\MinLength::class => [
                    'value' => 3,
                ],
                \Formularium\Validator\MaxLength::class =>  => [
                    'value' => 30,
                ],
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
                \Formularium\Validator\Max::class => [
                    'value' => 40,
                ],
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

## Sponsors

[![Corollarium](https://corollarium.github.io/Formularium/logo-horizontal-400px.png)](https://corollarium.com)
