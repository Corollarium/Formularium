# Datatypes

## Creating your own datatypes

Run this to create a class for a datatype called `mine`:

`php vendor/corollarium/formularium/util/makeDatatype.php --datatype=mine --basetype=string --namespace=MyApp\\Datatype --path=./src/ --test-path=./tests/`

If you are using Laravel, you can shorten it to (other options work too, but we provide sane defaults):

`artisan mine --basetype=string`

If you are developing Formularium itself, there's a composer shortcut:

`composer make:datatype -- --datatype=mine --basetype=string`

This will generate a file `Datatype_mine.php` with all the scaffolding. Fill the `getRandom()` and `validate()` methods, or just delete them to use the parent methods if you are inheriting from another basetype. You also get a `mineTest.php` file to implement your tests easily.

You often will want to use an existing basetype to inherit from existing datatypes. This will also use the Renderable from the basetype, so it will automatically render with all existing frontends automatically.

---

See also:

- [base validators available for all datatypes](basevalidator.md)
- [creating your own framework and renderable classes](frontend.md)
