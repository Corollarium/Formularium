
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RcJHjpnOMJS'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RmSJAdp'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RsqJ_VQ-Z'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true

SQL datatype: INT

Laravel SQL datatype: boolean(name)



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true

SQL datatype: INT

Laravel SQL datatype: boolean(name)



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '29.964.692/0001-70'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#1FF921'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'SM'

SQL datatype: CHAR(2)

Laravel SQL datatype: char('name', 2)



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'SCG'

SQL datatype: CHAR(3)

Laravel SQL datatype: char('name', 3)



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 466

SQL datatype: CHAR(3)

Laravel SQL datatype: char('name', 3)



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '502.993.937-71'

SQL datatype: VARCHAR(13)

Laravel SQL datatype: string(name, 13)



## currency

Currency names, with their 3-letter codes.

Random value example: 'CRC'

SQL datatype: CHAR(3)

Laravel SQL datatype: char(name, 3)



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2011-08-23'

SQL datatype: DATE

Laravel SQL datatype: date



## datetime

Datetimes in ISO8601 format.

Random value example: '2013-01-05T11:29:30+0000'

SQL datatype: DATETIME

Laravel SQL datatype: datetime('name')



## domain

Internet domain names.

Random value example: 'huel.com'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'amely61@gmail.com'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## file





## float

Floating point numbers.

Random value example: 0.464

SQL datatype: FLOAT

Laravel SQL datatype: float('name')



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Rerum dignissimos id quis exercitationem distinctio. Dolore ut ipsum est molestiae tenetur et rerum ut. Magni id rerum cum odio. Necessitatibus voluptates omnis nesciunt nam odit ea rerum.</span>Molestias fugiat fugit modi nostrum est qui qui iure. Ipsa quibusdam architecto incidunt quasi maxime libero.</p>'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -1238118709

SQL datatype: INT

Laravel SQL datatype: integer("name")



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: '150b:35e6:f918:6f05:50bd:b482:7fc6:af8c'

SQL datatype: VARCHAR(39)

Laravel SQL datatype: ipAdddress('name')



## ipv4

Datatype for IPs in IPV4 format

Random value example: '81.255.212.3'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## ipv6

Datatype for IPs in IPV6 format

Random value example: '49be:6187:a33:3a80:cb80:55ea:7336:48ee'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## json

Valid JSON data

Random value example: '{"version":-246558938,"data":{"string":"RUBKYZBhfZLc6oK","float":0.077}}'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## language

Languages. Names are in the actual language. Codes follow ISO 639-1 codes.

Random value example: 'ht'

SQL datatype: VARCHAR(10)

Laravel SQL datatype: string(name, 10)



## phone

A phone number in E164 format

Random value example: '+8065727472725'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RGR16sbwqmuyN'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## text

Strings in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Quidem qui excepturi cupiditate nihil vero est quis. Suscipit id voluptas quo sed facere delectus. Ipsum magnam commodi consequatur atque quibusdam illo consectetur.'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## time

Time (HH:MM:SS).

Random value example: '14:34:21'

SQL datatype: TIME

Laravel SQL datatype: time('name', 0)



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2013-12-06T21:19:49+0000'

SQL datatype: TIMESTAMP

Laravel SQL datatype: timestamp('name')



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Africa/Juba'

SQL datatype: VARCHAR(50)

Laravel SQL datatype: string(name, 50)



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1376463308

SQL datatype: INT UNSIGNED

Laravel SQL datatype: integer("name")->unsigned()



## url

Datatype for URLs

Random value example: 'http://veum.biz/qui-ut-beatae-et-rem-consequatur-quisquam-dolor.html'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 14712

SQL datatype: SMALLINT UNSIGNED

Laravel SQL datatype: smallInteger("name")->unsigned()



## uuid

Datatype for uuid values.

Random value example: '8e6dbdb5-2fa9-4c7a-9e91-63ebad4ab401'

SQL datatype: CHAR(16)

Laravel SQL datatype: uuid('name')



## year

Valid years. May create a special field in the database.

Random value example: -880022722

SQL datatype: INT

Laravel SQL datatype: year('name')


