# Formularium

This is a general form generator for PHP. It hosts a number of generators for different frameworks, as well as validators. The main feature is that it provides high level data types, allowing you to specify exactly what you expect of each field in a unified way for validation and form generation. Your fields are not strings, stop treating them as such.

Forms are generated from a simple structure, which can be serialized as JSON. It's easy to create new datatypes, either from zero or extending the base types provided. The generated code can be used as is or customized with fine tuning for those pesky cases that no tool ever gets right.

Check the kitchen sink examples and our documentation.


## Getting started

Install with composer:

```
composer required Corollarium/Formularium
```

## Supported frontend generators

Formularium is built in a way that generators can be chained, so you can combine a basic HTML form generator, with a CSS framework and a JS validator, or possibly get the form into a Vue or React component. We provide a number of frontend plugins and you can easily extend with your own (and submit a PR!)


- Base generators:
    - Pure HTML
- CSS Frameworks:
    - Bulma
    - Bootstrap 
- JS Frameworks/validators:
    - Vue

## Related