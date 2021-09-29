---
layout: default
nav_order: 3
---

# Basics

Formularium is defined on a few base class types:

- `Model`: this is what describes your object.
- `Field`: the attributes of a model. Fields are typed, and every field has its own datatype.
- `Datatype`: the type of an attribute. These are not the basic PHP types, but extensible datatypes that can be complex.
- `Validator`: a class that performs specific data validation.
- `Framework`: the framework to use (CSS/JS/etc). Frameworks work by composition, so you can combine them.
- `Renderable`: the frontend datatype render classes. Convert a datatype into rendered HTML.
- `Element`: the frontend basic element classes, such as buttons.

You can create models from a structure, programmatically or from a graphql description.

## Programmatically

```php
$model = Model::create(
    'TestModel', // your model name. Something like "Product".
    [ // the fields in this object
        Field::create(
            'myString', // the first field name.
            DatatypeFactory::factory('string'), // the field datatype. maps to Datatype_string in this case.
            [ // the validators to be applied. Validators are used by Datatypes, although Renderable can use them for frontend validation too.
                ValidatorFactory::class('MinLength') => [
                    'value' => true // so, make this field required.
                ]
            ],
            [ // renderable are used only by the frontend Renderable/Framework classes.
                Renderable::LABEL => 'This is some string', // so, let's add a label describing the field
            ]
        ]
    ]
];
```

## From graphql

TODO

Meanwhile, see [Modelarium, a full backend/frontend scaffolding generator for PHP/Laravel](https://github.com/Corollarium/modelarium/).

## From data structure

```php
$modelData = [
    'name' => 'TestModel', // your model name. Something like "Product".
    'fields' => [ // the fields in this object
        'myString' => [ // the first field name.
            'datatype' => 'string', // the field datatype. maps to Datatype_string in this case.
            'validators' => [ // the validators to be applied. Validators are used by Datatypes, although Renderable can use them for frontend validation too.
                Formularium\Validator\MinLength::class => [
                    'value' => 5 // so, make this field at least 5 characters long.
                ]
            ],
            'renderable' => [ // renderable are used only by the frontend Renderable/Framework classes.
                Renderable::LABEL => 'This is some string', // so, let's add a label describing the field
            ]
        ]
    ]
];
$model = Model::fromStruct($modelData); // use a factory method to convert the structure into a Model class.
```

## From JSON

```php
    $json = <<<EOF
{
    "name": "TestModel",
    "fields": {
        "myString": {
            "datatype": "string",
            "validators": [
                "MinLength": [
                    "value": 5
                ]
            ],
            "renderable" => [
                "label" => "This is some string",
            ]
        ]
    ]
];
EOF

$model = Model::fromJSON($modelData); // use a factory method to convert the structure into a Model class.
```

Once built, models can validate date, render a form or a read-only page.
