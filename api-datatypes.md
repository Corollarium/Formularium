
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RKmSKOgMFEMT'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RYT1Jbw'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RwcGGZ'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false

SQL datatype: INT

Laravel SQL datatype: boolean(name)



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false

SQL datatype: INT

Laravel SQL datatype: boolean(name)



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '32.375.760/0001-70'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#B67620'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'BZ'

SQL datatype: CHAR(2)

Laravel SQL datatype: char('name', 2)



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'ISR'

SQL datatype: CHAR(3)

Laravel SQL datatype: char('name', 3)



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 376

SQL datatype: CHAR(3)

Laravel SQL datatype: char('name', 3)



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '242.621.522-43'

SQL datatype: VARCHAR(13)

Laravel SQL datatype: string(name, 13)



## currency

Currency names, with their 3-letter codes.

Random value example: 'AMD'

SQL datatype: CHAR(3)

Laravel SQL datatype: char(name, 3)



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2013-05-25'

SQL datatype: DATE

Laravel SQL datatype: date



## datetime

Datetimes in ISO8601 format.

Random value example: '2016-07-28T13:11:50+0000'

SQL datatype: DATETIME

Laravel SQL datatype: datetime('name')



## domain

Internet domain names.

Random value example: 'bergnaum.com'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'dritchie@kautzer.org'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## file





## float

Floating point numbers.

Random value example: 0.071

SQL datatype: FLOAT

Laravel SQL datatype: float('name')



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Repudiandae enim voluptas accusantium laboriosam. Et velit ipsa pariatur iure. Deleniti harum unde consectetur occaecati officia tempora odit tenetur. Autem officia fuga a magni.</span>Et minus omnis nesciunt blanditiis amet totam aut. Accusantium est voluptatibus esse quia velit. Ut rerum vel animi voluptates. Consectetur veniam saepe ea consequuntur est sequi aut eos.</p>'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 2029309072

SQL datatype: INT

Laravel SQL datatype: integer("name")



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: '21.165.6.81'

SQL datatype: VARCHAR(39)

Laravel SQL datatype: ipAdddress('name')



## ipv4

Datatype for IPs in IPV4 format

Random value example: '73.77.63.222'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'df47:1f45:8ee6:9e0c:f4fb:f086:51cd:4632'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## json

Valid JSON data

Random value example: '{"version":-1159407531,"data":{"string":"RLi9YUKZoZBQ9Y","float":0.431}}'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'ty'

SQL datatype: VARCHAR(10)

Laravel SQL datatype: string(name, 10)



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'ki'

SQL datatype: CHAR(2)

Laravel SQL datatype: char('name', 2)



## phone

A phone number in E164 format

Random value example: '+8899317149837'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'Rrrsv'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## text

Strings in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Accusamus quia sed et labore. Ut at exercitationem officiis earum aut quasi. Dolor qui repellat consequuntur officia tempora et eos. Eius ipsa officia rerum est.'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## time

Time (HH:MM:SS).

Random value example: '23:41:34'

SQL datatype: TIME

Laravel SQL datatype: time('name', 0)



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2014-01-01T06:34:15+0000'

SQL datatype: TIMESTAMP

Laravel SQL datatype: timestamp('name')



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Santarem'

SQL datatype: VARCHAR(50)

Laravel SQL datatype: string(name, 50)



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 2402552323

SQL datatype: INT UNSIGNED

Laravel SQL datatype: integer("name")->unsigned()



## url

Datatype for URLs

Random value example: 'http://cremin.com/in-dolorem-quo-magni-totam-dolores'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 42338

SQL datatype: SMALLINT UNSIGNED

Laravel SQL datatype: smallInteger("name")->unsigned()



## uuid

Datatype for uuid values.

Random value example: 'de5ddfc1-51dc-44ad-8683-4420f7f07b95'

SQL datatype: CHAR(16)

Laravel SQL datatype: uuid('name')



## year

Valid years. May create a special field in the database.

Random value example: -2065012821

SQL datatype: INT

Laravel SQL datatype: year('name')


