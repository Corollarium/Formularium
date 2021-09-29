---
layout: default
nav_order: 4
---

# Extending Formularium

You can extend Formularium easily with your own datatypes, elements and even frameworks.

The easiest way to setup is a separate namespace with the same code structure that Formularium has:

- \YouNamespace
  - \CodeGenerator
  - \Datatype
  - \Frontend
    - \[FrontendFramework]
      - \Element
      - \Renderable
  - \Validator

Then you just have to register your namespace and any files there will be correctly auto-loaded:

```php
use Formularium\Factory\AbstractFactory;

AbstractFactory::appendBaseNamespace(
    'YourNamespace'
);
```

See the individual documentation about extending each of the primitives.
