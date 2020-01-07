# Base validation

These validators are available for any datatype. They should be used in the `validators` section of a field, like this:

```php
$modelData = [
    'name' => 'TestModel',
    'fields' => [
        'myString' => [
            'datatype' => 'string',
            'validators' => [
                Datatype::REQUIRED => true
            ]
        ]
    ]
];
$model = Model::fromStruct($modelData);

## Validators

- `Datatype::REQUIRED => true` 
Field must be present in data.

- `Datatype::FILLED => true` 
If present in data, field must not be empty.

- `Datatype::REQUIRED_WITH => [field1, field2]` 
The field under validation must be present and not empty only if any of the other specified fields `field1, field2...` are present.

- `Datatype::REQUIRED_WITH_ALL => [field1, field2]` 
The field under validation must be present and not empty only if all of the other specified fields are present.
