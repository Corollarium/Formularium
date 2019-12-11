# Formularium

This is a general form generator for PHP. It hosts a number of generators for different frameworks, as well as validators. The main feature is that it provides high level data types, allowing you to specify exactly what you expect of each field in a unified way for validation and form generation. Your fields are not strings, stop treating them as such.

Forms are generated from a simple structure, which can be serialized as JSON. It's easy to create new datatypes, either from zero or extending the base types provided. The generated code can be used as is or customized with fine tuning for those pesky cases that no tool ever gets right.

Check the [kitchen sink examples](https://corollarium.github.io/Formularium/kitchensink).

## Getting started

Install with composer:

```
composer required Corollarium/Formularium
```

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

## How to

- [create your own datatype](datatype.md)
- [add support to your own frontend framework](frontend.md)
