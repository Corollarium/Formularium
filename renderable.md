# Renderable

## Creating your own renderable

Sometimes you need to customize the rendered output as well, to implement specific widgets, add new attributes to the HTML etc. Renderables work by composition, so often you may just write the classe for the `HTML` frontend. You can use a script to generate the class stub for you.

`bash vendor/corollarium/formularium/util/makeFramework.sh [yourfrontend] Datatype_xxx.php`

This will generate a `Frontend/[yourfrontend]/Renderable/Renderable_xxx.php` file.

You often will want to use an existing basetype to inherit and just alter the HTML. Remember that you may receive HTML from previous frameworks and other ones might use it later when implementing your code.

Remember to register your namespace in your application so they can be autoloaded:

```php
Formularium::appendRenderableNamespace('MyApp\\Renderable');
```

## Parameters

These are basic parameters often supported for renderables:

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

---

See also:

- [datatypes](datatype.md)
- [frameworks](framework.md)
