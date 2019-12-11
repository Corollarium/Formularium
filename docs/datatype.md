# Datatypes

## Creating your own datatypes

Run this to create a class for a datatype called `mine`:

`php vendor/corollarium/formularium/util/makeDatatype.php --datatype=mine --basetype=string --path=.`

Edit the created file `Datatype_mine.php` and fill the `getRandom()` and `validate()` methods.

You often will want to use an existing basetype to inherit from existing datatypes. This will use the same Renderable from the basetype, so it will automatically render without any extra frontend code. Here's how to write your own Renderable class.