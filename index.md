---
layout: default
title: Formularium
nav_order: 1
---

# Formularium

This is an [open source general frontend generator and backend validator for PHP](https://github.com/Corollarium/Formularium/). It hosts a number of generators for different CSS frameworks, as well as validators. The main feature is that it provides high level data types, allowing you to specify exactly what you expect of each field in a unified way for validation and form generation. Your fields are not strings, stop treating them as such.

Forms are generated from a simple structure, which can be serialized as JSON. It's easy to create new datatypes, either from zero or extending the base types provided. The generated code can be used as is or customized with fine tuning for those pesky cases that no tool ever gets right.

Check:

- [getting started](./gettingstarted.md)
- [kitchen sink demo](https://corollarium.github.io/Formularium/kitchensink)
- [a basic hello world example in pure PHP](https://github.com/Corollarium/Formularium-example)
- [Modelarium, a full backend/frontend scaffolding generator for PHP/Laravel](https://github.com/Corollarium/modelarium/).

### Same code, different frontend frameworks

[![Bootstrap](https://corollarium.github.io/Formularium/shots/HTMLBootstrapQuill.png)](https://corollarium.github.io/Formularium/kitchensink/HTMLHTMLValidationBootstrapQuill.html)
[![Bulma](https://corollarium.github.io/Formularium/shots/HTMLBulmaQuill.png)](https://corollarium.github.io/Formularium/kitchensink/HTMLHTMLValidationBulmaQuill.html)
[![Materialize](https://corollarium.github.io/Formularium/shots/HTMLMaterialize.png)](https://corollarium.github.io/Formularium/kitchensink/HTMLHTMLValidationMaterialize.html)
[![Buefy](https://corollarium.github.io/Formularium/shots/HTMLBuefyVue.png)](https://corollarium.github.io/Formularium/kitchensink/HTMLHTMLValidationBootstrapVue.html)

## Documentation

- [getting started: how to declare your models](model.md)
- [how to create your own datatype](datatype.md)
- [how to create your own validators](validator.md)
- [how to create your own renderables](renderable.md)
- [how to create your own elements](element.md)
- [how to add support to your own frontend framework](framework.md)
- [how to add support to your own code generator targets](codegenerator.md)

### Reference

- [all validators and their parameters](api-validators.md)
- [all datatypes](api-datatypes.md)
- elements and their parameters:
  - [Bootstrap](api-Bootstrap-elements.md)
  - [Buefy](api-Buefy-elements.md)
  - [Bulma](api-Bulma-elements.md)
  - [HTML](api-HTML-elements.md)
  - [Materialize](api-Materialize-elements.md)

## Sponsors

[![Corollarium](https://corollarium.github.io/Formularium/logo-horizontal-400px.png)](https://corollarium.com)
