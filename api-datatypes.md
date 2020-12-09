
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RJwOpdO'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'ReCOejF8JvvCGfv'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'R0Hr6N'

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

Random value example: '94.376.247/0001-50'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#8B774E'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'MF'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'AFG'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 249

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '167.171.781-32'

SQL datatype: `VARCHAR(13)`

Laravel SQL datatype: `string(name, 13)`



## currency

Currency names, with their 3-letter codes.

Random value example: 'LAK'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char(name, 3)`



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2027-03-28'

SQL datatype: `DATE`

Laravel SQL datatype: `date('name')`



## datetime

Datetimes in ISO8601 format.

Random value example: '2016-05-19T03:29:56+0000'

SQL datatype: `DATETIME`

Laravel SQL datatype: `datetime('name')`



## domain

Internet domain names.

Random value example: 'jaskolski.com'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'santiago.davis@little.com'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## file





## float

Floating point numbers.

Random value example: 0.644

SQL datatype: `FLOAT`

Laravel SQL datatype: `float('name')`



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Corrupti tenetur placeat quas eum neque et. Nobis quod rerum et aut aut voluptatem consequatur. Rerum itaque iusto ipsum temporibus facere sed. Itaque provident nulla et minima aut fugiat est et.</span>In reprehenderit tempore iste consequatur. Aut magni sapiente qui cumque eos aliquid. Laboriosam esse illo ipsam id cumque. Doloremque quia neque aut.</p>'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 1278925023

SQL datatype: `INT`

Laravel SQL datatype: `integer("name")`



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'e645:bc20:4744:ce8a:9a1c:2291:b90c:745b'

SQL datatype: `VARCHAR(39)`

Laravel SQL datatype: `ipAdddress('name')`



## ipv4

Datatype for IPs in IPV4 format

Random value example: '209.195.42.154'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## ipv6

Datatype for IPs in IPV6 format

Random value example: '6e1f:e23a:e96b:25ed:1d25:fbec:a08c:5b5'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## json

Valid JSON data

Random value example: '{"version":756259986,"data":{"string":"RZQHpJWDwqvte2SEJCCq1JPzU99ZkTWrs6B2Q2fbltJOCRXLoS5SFevwO7hHKv0DXYyzpEWfj9sdF1ROLaXyKK5jSrRiqPw7x5nMVj6PdpBk86W","float":0.029}}'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'kn'

SQL datatype: `VARCHAR(10)`

Laravel SQL datatype: `string(name, 10)`



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'be'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Elnora Simonis'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## phone

A phone number in E164 format

Random value example: '+2106661135128'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RQMLIAlK2tNQaYO7Tfid36aHkhSmEFrLKc4WppglMUKx69o9EKxQEl7gxnz1BoiWpUh5DtWQ5iu8pnQT0ss6QTqo6xR7LaqPfejTAoeH063U9T0MxfW3rQokoLaqX8Z0p9X57FK5uqhinnL3BJsB5i0nU'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Qui architecto non ex eligendi in praesentium. Eos est praesentium harum ut accusantium temporibus ad. Repellat dolorem dolore laudantium quae.'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## time

Time (HH:MM:SS).

Random value example: '22:47:32'

SQL datatype: `TIME`

Laravel SQL datatype: `time('name', 0)`



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2025-07-20T17:13:16+0000'

SQL datatype: `TIMESTAMP`

Laravel SQL datatype: `timestamp('name')`



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Africa/Nairobi'

SQL datatype: `VARCHAR(50)`

Laravel SQL datatype: `string(name, 50)`



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1328864116

SQL datatype: `INT UNSIGNED`

Laravel SQL datatype: `integer("name")->unsigned()`



## url

Datatype for URLs

Random value example: 'http://greenfelder.org/aut-nesciunt-nisi-iure-veritatis-commodi'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 46852

SQL datatype: `SMALLINT UNSIGNED`

Laravel SQL datatype: `smallInteger("name")->unsigned()`



## uuid

Datatype for uuid values.

Random value example: '2717fcdf-0176-4223-919a-cae8add954d8'

SQL datatype: `CHAR(16)`

Laravel SQL datatype: `uuid('name')`



## year

Valid years. May create a special field in the database.

Random value example: 2006

SQL datatype: `INT`

Laravel SQL datatype: `year('name')`


