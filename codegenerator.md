# Code Generator

The [Framework](framework.md) pipeline is oriented to HTML generation. It's not suitable for other types of code generation, such as SQL tables or TypeScript interfaces. To handle other, more general outputs that are not based on a HTML tree, use the `CodeGenerator` infrastructure.

To implement your own code generator you'll have to implement the `DatatypeGenerator_[datatype]` classes. There's a script that will generate the scaffolding for you:

`./composer.phar make:codegenerator -- MyGenerator`

If you are doing this for your own project, you can run instead:

`bash vendor/corollarium/formularium/util/makeCodeGenerator.sh MyTargetName`

Which will generate all classes for all non-abstract datatypes, and the main `CodeGenerator` class itself.

---

See also:

- [datatypes](datatype.md)
- [framework](framework.md)
