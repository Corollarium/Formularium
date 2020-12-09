
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RytRwbYDZsx'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'R4mxYXNVI8S3B'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'R4_bswi1EiqY0kA'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false

SQL datatype: `INT`

Laravel SQL datatype: `boolean(name)`



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true

SQL datatype: `INT`

Laravel SQL datatype: `boolean(name)`



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '05.703.901/0001-63'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#1A36DD'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'US'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'WSM'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 438

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '847.291.224-88'

SQL datatype: `VARCHAR(13)`

Laravel SQL datatype: `string(name, 13)`



## currency

Currency names, with their 3-letter codes.

Random value example: 'KMF'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char(name, 3)`



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2023-12-12'

SQL datatype: `DATE`

Laravel SQL datatype: `date('name')`



## datetime

Datetimes in ISO8601 format.

Random value example: '2023-07-28T22:49:26+0000'

SQL datatype: `DATETIME`

Laravel SQL datatype: `datetime('name')`



## domain

Internet domain names.

Random value example: 'sipes.com'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'willie30@mertz.net'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## file





## float

Floating point numbers.

Random value example: 0.955

SQL datatype: `FLOAT`

Laravel SQL datatype: `float('name')`



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Esse animi sit iure libero aliquid aut eligendi aut. Quisquam alias ut consequatur rem nulla ipsa corporis. Sequi velit aperiam voluptatem. Commodi ab nisi rerum accusantium non.</span>Sint adipisci sunt dolores omnis. Sint aut reiciendis est iste laborum atque. Reiciendis magnam temporibus omnis sed et rerum vel.</p>'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 1912554212

SQL datatype: `INT`

Laravel SQL datatype: `integer("name")`



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'cd39:751b:7a4e:ea2d:c48b:af32:c4fe:5352'

SQL datatype: `VARCHAR(39)`

Laravel SQL datatype: `ipAdddress('name')`



## ipv4

Datatype for IPs in IPV4 format

Random value example: '204.19.58.111'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'a8:3250:34ff:5dc7:a451:b4fd:38b4:3b45'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## json

Valid JSON data

Random value example: '{"version":1640175061,"data":{"string":"Rw42hMdlocUT0g7CKPJudyVIu7A2kcnTxiQyJnC3Erj1yKhplyJjwY4XqRoWDQMLCn6e3Pm13hmYkOPyISAomYaH6Eg4gbUTtuNJcAz91GMy4TNuFaxaGsGK5iXilgByNLdyzISeUo8J","float":0.333}}'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'ha'

SQL datatype: `VARCHAR(10)`

Laravel SQL datatype: `string(name, 10)`



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'he'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Dr. Gaston Stark'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## phone

A phone number in E164 format

Random value example: '+8064956460929'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RW7HwAqJAvoVbrrKWV8Te3jjNatTPVpYVYyu1rPyGhY6Y5gokakAbcBBRnv'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Est qui possimus recusandae vero vero. Veritatis velit odit aut velit. Voluptas possimus facilis et in voluptatibus id dolorum. Veritatis quo ratione iure eum cum ut.'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## time

Time (HH:MM:SS).

Random value example: '04:33:43'

SQL datatype: `TIME`

Laravel SQL datatype: `time('name', 0)`



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2018-08-24T05:34:31+0000'

SQL datatype: `TIMESTAMP`

Laravel SQL datatype: `timestamp('name')`



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Africa/Ceuta'

SQL datatype: `VARCHAR(50)`

Laravel SQL datatype: `string(name, 50)`



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1048609167

SQL datatype: `INT UNSIGNED`

Laravel SQL datatype: `integer("name")->unsigned()`



## url

Datatype for URLs

Random value example: 'https://wintheiser.net/blanditiis-sed-quis-molestias.html'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 8206

SQL datatype: `SMALLINT UNSIGNED`

Laravel SQL datatype: `smallInteger("name")->unsigned()`



## uuid

Datatype for uuid values.

Random value example: 'e10087f2-c60a-4d98-91b6-beceb3a92356'

SQL datatype: `CHAR(16)`

Laravel SQL datatype: `uuid('name')`



## year

Valid years. May create a special field in the database.

Random value example: 2002

SQL datatype: `INT`

Laravel SQL datatype: `year('name')`


