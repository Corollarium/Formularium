
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RqqdVzkknkOL'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RAe062bPSHfye'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'Rasdcgf0Gvo0'

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

Random value example: '71.442.864/0001-01'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#A3D2CB'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'GT'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'OMN'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 586

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '998.926.860-63'

SQL datatype: `VARCHAR(13)`

Laravel SQL datatype: `string(name, 13)`



## currency

Currency names, with their 3-letter codes.

Random value example: 'GYD'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char(name, 3)`



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2021-05-05'

SQL datatype: `DATE`

Laravel SQL datatype: `date`



## datetime

Datetimes in ISO8601 format.

Random value example: '2019-10-25T11:17:35+0000'

SQL datatype: `DATETIME`

Laravel SQL datatype: `datetime('name')`



## domain

Internet domain names.

Random value example: 'hammes.info'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'jamison.walsh@kilback.org'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## file





## float

Floating point numbers.

Random value example: 0.824

SQL datatype: `FLOAT`

Laravel SQL datatype: `float('name')`



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Numquam cum ut culpa ut. Alias aut commodi qui.</span>Porro expedita molestiae nihil explicabo culpa. Eos consequatur rerum exercitationem ut deleniti quam commodi necessitatibus. Eos aut in nobis eius.</p>'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -348591679

SQL datatype: `INT`

Laravel SQL datatype: `integer("name")`



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: '158.59.178.160'

SQL datatype: `VARCHAR(39)`

Laravel SQL datatype: `ipAdddress('name')`



## ipv4

Datatype for IPs in IPV4 format

Random value example: '65.164.74.176'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## ipv6

Datatype for IPs in IPV6 format

Random value example: '1b76:538b:f463:4740:7cc3:94df:8eac:a0c1'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## json

Valid JSON data

Random value example: '{"version":542349125,"data":{"string":"RZx5SLOjmj3YcjqgLxotixeFKCxgbtV805o7qqZN8KPuwowfR7koaK9GUsWnMocbbrA7aINcIvjtOlc7TB4AGgPSXVPS1x1v5WcYhwiRuZ1Y0uPoBECsuIbykZ0nEh3IGNf9CeyJT1b2pVk8pbWbfuhhspzCqgS3toj6a7Ar5F1WZEWjyA9MGX5ZDvaHd","float":0.151}}'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'mr'

SQL datatype: `VARCHAR(10)`

Laravel SQL datatype: `string(name, 10)`



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'it'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## phone

A phone number in E164 format

Random value example: '+7038899892905'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RYRuJfsAfrceef7k6KO3T58I1EoRJlRGCgvyYCMLznlJTHR2od1PYFa5ZGkZlifjceubLj8eBAQE75vzHvMtBSf94XRhroeEq4S6FKNBkCupLQKxjhTtIhhtjaFoi038NUzcZFkK5xzsg6HXV2buYzN3q7I8r'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Ex voluptas enim officiis. Aut neque vel nemo molestias ut. Dolor id placeat quam consequatur est. Quae consectetur mollitia non eveniet et et et. Qui aut id est harum dolor voluptates.'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## time

Time (HH:MM:SS).

Random value example: '13:21:51'

SQL datatype: `TIME`

Laravel SQL datatype: `time('name', 0)`



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2028-05-04T16:05:16+0000'

SQL datatype: `TIMESTAMP`

Laravel SQL datatype: `timestamp('name')`



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Belize'

SQL datatype: `VARCHAR(50)`

Laravel SQL datatype: `string(name, 50)`



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1865830510

SQL datatype: `INT UNSIGNED`

Laravel SQL datatype: `integer("name")->unsigned()`



## url

Datatype for URLs

Random value example: 'http://www.cormier.org/dolor-maiores-excepturi-et-aut-voluptatum'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 54704

SQL datatype: `SMALLINT UNSIGNED`

Laravel SQL datatype: `smallInteger("name")->unsigned()`



## uuid

Datatype for uuid values.

Random value example: 'ec01c19a-7887-4815-aa12-2c0a5e641458'

SQL datatype: `CHAR(16)`

Laravel SQL datatype: `uuid('name')`



## year

Valid years. May create a special field in the database.

Random value example: -1341933010

SQL datatype: `INT`

Laravel SQL datatype: `year('name')`


