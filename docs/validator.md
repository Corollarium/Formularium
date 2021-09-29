---
layout: default
nav_order: 7
---

# Validators

Validator are general classes responsible for checking if data adheres to a certain pattern. They can be reused by fields and datatypes.

They can be used in the `validators` section of a field, like this:

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

They can also be called in a `Datatype::getValidators()` method, which is probably more fitting -- you want the validation as part of the datatype, not as an agreggation of restrictions.

## Creating your own validator

Validators are classes, implementing the `ValidatorInterface` interface.

Run this to create a class for a validator called `mine`:

`php vendor/corollarium/formularium/util/makeValidator.php --validator=mine --namespace=MyApp\\Formularium\\Validator --path=./src/ --test-path=./tests/`

If you are using Laravel, you can shorten it to (other options work too, but we provide sane defaults):

`artisan formularium:validator mine --basetype=string`

If you are developing Formularium itself, there's a composer shortcut:

`composer make:validator -- --validator=mine`

This will generate a file `Mine.php` with all the scaffolding. Fill the `getMetadata()` and `validate()`. You also get a `mineTest.php` file to implement your tests easily.

## Example

Let's take a look at the `Equals` validator for an example:

```php
<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Equals implements ValidatorInterface
{
    public static function validate($value, array $options = [], ?Model $model = null)
    {
        if ($value !== $options['value']) {
            throw new ValidatorException('Value is not the expected');
        }

        return $value;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Equals',
            "Match exactly",
            [
                new MetadataParameter(
                    'value',
                    'String!',
                    'Value'
                )
            ]
        );
    }
}
```

---

See also:

- [datatypes](datatype.md)
- [renderable](renderable.md)
