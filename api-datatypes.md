
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RsVQn'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RnCWsMkcnT'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'R6qxF1zq'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true

SQL datatype: `INT`

Laravel SQL datatype: `boolean(name)`



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false

SQL datatype: `INT`

Laravel SQL datatype: `boolean(name)`



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '96.994.755/0001-28'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#8E5850'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'GY'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'QAT'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 548

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '479.613.606-11'

SQL datatype: `VARCHAR(13)`

Laravel SQL datatype: `string(name, 13)`



## currency

Currency names, with their 3-letter codes.

Random value example: 'TJS'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char(name, 3)`



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2023-12-25'

SQL datatype: `DATE`

Laravel SQL datatype: `date('name')`



## datetime

Datetimes in ISO8601 format.

Random value example: '2012-09-02T15:21:18+0000'

SQL datatype: `DATETIME`

Laravel SQL datatype: `datetime('name')`



## domain

Internet domain names.

Random value example: 'brekke.com'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'liliana.upton@hotmail.com'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## file





## float

Floating point numbers.

Random value example: 0.769

SQL datatype: `FLOAT`

Laravel SQL datatype: `float('name')`



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Est ea ducimus dolor nulla ea. Veniam impedit illum quibusdam id. A repellat possimus laborum quia reiciendis suscipit.</span>Asperiores iusto similique nesciunt ipsa provident sed. Soluta voluptatem veritatis tenetur ut quaerat quibusdam aut. Eum qui omnis id iste soluta est. Accusantium in reiciendis suscipit labore.</p>'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -1217616798

SQL datatype: `INT`

Laravel SQL datatype: `integer("name")`



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'd426:5a9d:bfc4:ab13:7536:c1ef:12d8:f516'

SQL datatype: `VARCHAR(39)`

Laravel SQL datatype: `ipAdddress('name')`



## ipv4

Datatype for IPs in IPV4 format

Random value example: '85.34.111.62'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'ff0b:3edd:81e:2aad:6e17:3649:995b:4dd'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## json

Valid JSON data

Random value example: '{"version":-2038442944,"data":{"string":"Rq0d49aBhIXX8FUEtTdraZJF3B7wRTqzjHJpSUS6eZGwI5H2NHpMNSMjcjq7Gg1steimBB3F8RsODH5BT2asTXbYdb7qjQ2F2QPRVDgNpGQeCB76E7tlVJYUgpkVarCuE7tmSAVsFVvwSQU","float":0.38}}'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'tk'

SQL datatype: `VARCHAR(10)`

Laravel SQL datatype: `string(name, 10)`



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'lu'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Kelley Jaskolski'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## phone

A phone number in E164 format

Random value example: '+7122733544340'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RpMED9MOvpnUilYByFX0irR19HYx6L3BCcr3plM5fyBhVbx1WhMDvexIsfXRmMvoj5OkGlRLsm6o29pbwuMY413rgJLXgW8rnsdC16U4zZXz4cu5fyihNb5lCYkkEyK59Nz3oHHFLeeg9rozqI32VG6jbfBU2'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Sapiente omnis similique repellendus optio. Hic consequatur aspernatur rem modi repellat consectetur vel. Qui illum eaque non voluptatem voluptatem et nisi quia.'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## time

Time (HH:MM:SS).

Random value example: '01:33:20'

SQL datatype: `TIME`

Laravel SQL datatype: `time('name', 0)`



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2029-02-12T08:17:09+0000'

SQL datatype: `TIMESTAMP`

Laravel SQL datatype: `timestamp('name')`



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Anguilla'

SQL datatype: `VARCHAR(50)`

Laravel SQL datatype: `string(name, 50)`



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 2458850836

SQL datatype: `INT UNSIGNED`

Laravel SQL datatype: `integer("name")->unsigned()`



## url

Datatype for URLs

Random value example: 'http://homenick.com/'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 63352

SQL datatype: `SMALLINT UNSIGNED`

Laravel SQL datatype: `smallInteger("name")->unsigned()`



## uuid

Datatype for uuid values.

Random value example: '96145b9f-60c8-4148-9ebe-a82a3290edcd'

SQL datatype: `CHAR(16)`

Laravel SQL datatype: `uuid('name')`



## year

Valid years. May create a special field in the database.

Random value example: 2014

SQL datatype: `INT`

Laravel SQL datatype: `year('name')`


