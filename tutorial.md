---
layout: default
title: Getting started
nav_order: 2
---

# Getting started

Formularium is a low level implementation. You might want to check [Modelarium, a full backend/frontend scaffolding generator for PHP with bindings for Laravel](https://github.com/Corollarium/modelarium/) instead.

Install with composer:

```
composer required Corollarium/Formularium
```

Here's a minimal commented sample:

```php
// set your framework composition.
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

// generate a typescript interface, like `type TestModel { ... }`
$codeGenerator = new \Formularium\CodeGenerator\Typescript\CodeGenerator();
$fields = $codeGenerator->type($model);


```
