# Framework

Formularium supports extension with your favorite frameworks by composition. This means that the frameworks are run in a pipeline, making it easy to compose a CSS framework with a validator framework, for example. Each framework in the pipeline alters the HTML from the previous step.

To implement your own framework you'll have to implement the `Renderable_[datatype]` classes. There's a script that will generate the scaffolding for you:

`./composer.phar make:framework -- MyFramework`

If you are doing this for your own project, you can run instead:

`bash vendor/corollarium/formularium/util/makeFramework.sh MyFramework`

The `Framework` class can set the elements added to `<head>` or to the bottom of the page (which can be used to generate standalone pages, like in the kitchen sink) and the final composition of the rendered elements (useful if you are implementing support for a JS framework like Vue which requires extra scaffolding).

# Renderable

## Creating your own renderable

Run this to create a class for a datatype called `mine`:

`php vendor/corollarium/formularium/util/makeDatatype.php --datatype=mine --basetype=string --path=.`

Edit the created file `Datatype_mine.php` and fill the `getRandom()` and `validate()` methods.

You often will want to use an existing basetype to inherit from existing datatypes. This will use the same Renderable from the basetype, so it will automatically render without any extra frontend code. Here's how to write your own Renderable class.