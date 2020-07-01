# Base validation

These validators are available for any datatype. They should be used in the `validators` section of a field, like this:

```php
$modelData = [
    'name' => 'TestModel',
    'fields' => [
        'myString' => [
            'datatype' => 'integer',
            'validators' => [
                Formularium\Validator\Min::class [
                    'value' => 10
                ]
            ]
        ]
    ]
];
$model = Model::fromStruct($modelData);
```

## Validators

Validators are classes, implementing the `ValidatorInterface` interface.
