
# Validators

List of validators and its parameters generated automatically.

## Equals

Match exactly

### value (String!)

Value


## File

File validations.

### maxSize (Int)

Maximum file size in bytes

### accept ([String])

Acceptable types


## Filled

Field may not be present, but if it is must not be empty.



## Image

Image file validations.

### dimensionRatio (Float)

The expected ratio (width/height)


## In

In list

### value ([String!]!)

Value


## Max

Maximum value

### value (Int)

Value


## MaxLength

Maximum string length

### value (Int)

Value


## Min

Minimum value

### value (Int)

Value


## MinLength

Minimum string length

### value (Int)

Value


## NotIn

Not in list

### value ([String!]!)

Value


## Password

Validates passwords

### minLength (Int)

Minimum password length

### entropy (Float)

Minimum entropy. Default: 2


## Regex

Regular expression validator

### value (String)

Regular expression, PHP style


## RequiredWith

The field under validation must be present and not empty only if any of the other specified fields are present.

### fields ([String])

The fields that are required with


## RequiredWithAll

The field under validation must be present and not empty only if all of the other specified fields are present.

### fields ([String])

The fields that are required with


## SameAs

Must be the same as a target field.

### target (String)

Target field

