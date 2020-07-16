# Validators

These validators are available to complement datatype restrictions. They can be used in the `validators` section of a field, like this:

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

They can also be called in a `Datatype::validate()` method, which is probably more fitting -- you want the validation as part of the datatype, not as an agreggation of restrictions.

## Creating your own validator

Validators are classes, implementing the `ValidatorInterface` interface.

Run this to create a class for a validator called `mine`:

`php vendor/corollarium/formularium/util/makeValidator.php --validator=mine --namespace=MyApp\\Validator --path=./src/ --test-path=./tests/`

If you are using Laravel, you can shorten it to (other options work too, but we provide sane defaults):

`artisan formularium:validator mine --basetype=string`

If you are developing Formularium itself, there's a composer shortcut:

`composer make:validator -- --validator=mine`

This will generate a file `Mine.php` with all the scaffolding. Fill the `getMetadata()` and `validate()`. You also get a `mineTest.php` file to implement your tests easily.

Remember to register your datatype namespace in your application so they can be autoloaded:

```php
Formularium::appendValidatorNamespace('MyApp\\Validators');
```

---

See also:

- [datatypes](datatype.md)
- [renderable](renderable.md)
