# Datatypes

## Creating your own datatypes

Run this to create a class for a datatype called `mine`:

`php vendor/corollarium/formularium/util/makeDatatype.php --datatype=mine --basetype=string --path=.`

This will generate a file `Datatype_mine.php` with all the scaffolding. Fill the `getRandom()` and `validate()` methods, or just delete them to use the parent methods if you are inheriting from another basetype.

You often will want to use an existing basetype to inherit from existing datatypes. This will also use the Renderable from the basetype, so it will automatically render with all existing frontends automatically. 

***
See also:
- [base validators available for all datatypes](basevalidator.md)
- [creating your own framework and renderable classes](frontend.md)