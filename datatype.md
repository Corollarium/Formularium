---
layout: default
nav_order: 5
---

# Datatypes

## Creating your own datatypes

Run this to create a class for a datatype called `mine`:

`php vendor/corollarium/formularium/util/makeDatatype.php --datatype=mine --basetype=string --namespace=MyApp\\Formularium\\Datatype --path=./src/ --test-path=./tests/`

If you are using Laravel, you can shorten it to (other options work too, but we provide sane defaults):

`artisan formularium:datatype mine --basetype=string`

If you are developing Formularium itself, there's a composer shortcut:

`composer make:datatype -- --datatype=mine --basetype=string`

This will generate a file `Datatype_mine.php` with all the scaffolding. Fill the `getRandom()` and `validate()` methods, or just delete them to use the parent methods if you are inheriting from another basetype. You also get a `mineTest.php` file to implement your tests easily.

You often will want to use an existing basetype to inherit from existing datatypes. This will also use the corresponding `Renderable` from the basetype, so it will automatically render with all existing frontends automatically.

Remember to register your datatype namespace in your application so they can be autoloaded:

```php
use Formularium\Factory\AbstractFactory;

AbstractFactory::appendBaseNamespace(
    'YourNamespace'
);
```

## Example: zip code

Let's look at a datatype for a zip code. For this fictitious zip code format, we want it to be between 5 and 8 characters, and composed only of upper case letters and numbers. We'll inherit from the `string` datatype:

```php
<?php declare(strict_types=1);

namespace YourNamespace\Datatype;

use Formularium\Model;

use Formularium\Exception\ValidatorException;
use Formularium\Validator\Regex;

class Datatype_zipcode extends \Formularium\Datatype\Datatype_string
{
    // let's update the values from Datatype_string for our limits.
    protected $MIN_STRING_LENGTH = 5;
    protected $MAX_STRING_LENGTH = 8;

    public function __construct(string $typename = 'zipcode', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        // this is a random string following our validation pattern.
        // you can use any code that generates proper data here.
        return static::getRandomString(
            $this->MIN_STRING_LENGTH,
            $this->MAX_STRING_LENGTH,
            "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
        );
    }

    public function getValidators(): array
    {
        // let's add an extra validator here to match our pattern.
        return array_merge(
            parent::getValidators(),
            [
                Regex::class => [
                    'value' => '/^([A-Z0-9]){5,8}$/'
                ],
            ]
        );
    }

    public function validate($value, Model $model = null)
    {
        // you can add your own special validation here besides the one in `getValidators()`.
        // this is more flexible one you need validation for only this specific datatype
        // instead of a general validator class.
        // for the sake of this example, let's say we want to block certain zipcodes.

        // let's first inherit validation from our base type. this will do the basic validation.
        $value = parent::validate($value, $model);
        if ($value === '012345' || $value === 'ABCDE') {
            throw new ValidatorException('This zipcode is blocked, sorry.');
        }

        // we return the $value, which might have been changed by the validator. This makes it
        // possible to convert to a well-defined format even if more than one format is
        // allowed. So we could allow lower case, for example, but convert to upper case.
        return $value;
    }

    public function getDocumentation(): string
    {
        return 'Datatype for our magic zip code format.';
    }
}
```

---

See also:

- [extending Formularium](extending.md)
- [validators](validator.md)
- [renderable](renderable.md)
