# Base validation

These validators are available for any datatype. They should be used in the `validators` section of a field, like this:

```php
$modelData = [
    'name' => 'TestModel',
    'fields' => [
        'myString' => [
            'datatype' => 'string',
            'extensions' => [
                Renderable::LABEL => 'My label'
            ]
        ]
    ]
];
$model = Model::fromStruct($modelData);
```

## Validators

- `Renderable::COMMENT => string`
A comment to be printed explaining the field.

- `Renderable::DEFAULTVALUE => mixed`
A default value

- `Renderable::DISABLED => boolean`
Render, but make it disabled

- `Renderable::HIDDEN => boolean`
Render, but make it hidden

- `Renderable::ICON => string`
Add an icon. Value is the icon class name.

- `Renderable::ICON_PACK => string`
Add an icon. Sometimes icons have packs, such as `fas` for FontAwesome. Requires the `ICON` extension too.

- `Renderable::LABEL => string`
The field label.

- `Renderable::NAME => string`
Overrides the html "name" attribute. If you want to do something really special with this data.

- `Renderable::PLACEHOLDER => string`
Uused to fill html placeholder field.

- `Renderable::READONLY => bool`
Render but make it readonly.

- `Renderable::SIZE => Renderable::SIZE_LARGE|Renderable::SIZE_NORMAL|Renderable::SIZE_SMALL`
Change the field size.
