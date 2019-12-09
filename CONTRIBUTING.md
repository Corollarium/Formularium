Please follow the guidelines to contribute.

- Follow PSR-4 and PSR-2 for code style. You can autoformat your code with `composer format`.

# Datatypes

- Add a new datatype on `Datatype/`. Please provide a test case in `tests/Datatype`. We wrote a basic phpunit class `DatatypeBaseTestCase`, so you essentially need to write three methods: a factory method, one with valid cases and one with invalid cases. Run `composer run-script make:datatype -- yourdatatype` to create all this scaffolding for you.

# Renderers

-