
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RSCkdRdcsbCct'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'R8rXdLiBjV'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RS82t8WzIutEgW'

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

Random value example: '74.995.485/0001-37'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#320E92'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'SR'

SQL datatype: CHAR(2)

Laravel SQL datatype: char('name', 2)



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'GRC'

SQL datatype: CHAR(3)

Laravel SQL datatype: char('name', 3)



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: '050'

SQL datatype: CHAR(3)

Laravel SQL datatype: char('name', 3)



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '715.392.459-00'

SQL datatype: VARCHAR(13)

Laravel SQL datatype: string(name, 13)



## currency

Currency names, with their 3-letter codes.

Random value example: 'AFN'

SQL datatype: CHAR(3)

Laravel SQL datatype: char(name, 3)



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2010-12-07'

SQL datatype: DATE

Laravel SQL datatype: date



## datetime

Datetimes in ISO8601 format.

Random value example: '2021-07-08T14:31:19+0000'

SQL datatype: DATETIME

Laravel SQL datatype: datetime('name')



## domain

Internet domain names.

Random value example: 'mueller.info'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'chandler.adams@armstrong.net'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## file





## float

Floating point numbers.

Random value example: 0.58

SQL datatype: FLOAT

Laravel SQL datatype: float('name')



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Nihil aliquam repellat sapiente dolorem reiciendis nobis non ipsam. Enim reprehenderit sapiente vero libero. Est aut et voluptatem qui sed maiores.</span>Voluptate quo molestias ullam vero tempora perferendis sed. Eum beatae minus quaerat dolorum in eligendi.</p>'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 2146464853

SQL datatype: INT

Laravel SQL datatype: integer("name")



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: '91.227.31.28'

SQL datatype: VARCHAR(39)

Laravel SQL datatype: ipAdddress('name')



## ipv4

Datatype for IPs in IPV4 format

Random value example: '16.193.144.132'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## ipv6

Datatype for IPs in IPV6 format

Random value example: '9607:dd8:7c15:287:ab8b:d6af:707:5902'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## json

Valid JSON data

Random value example: '{"version":2118202181,"data":{"string":"RQPQSlxQbxsoqGB6mBoUk95uYv7N7EKVDB1sTWcLLzmcdOScPNoXazCh5FrD2us3omW5N36KlR79iwWWrT8lt8qtU2sARVW6qXXvEZ4UWZHjTqIyqaQS9ZDGljjKXB2ofhrk2XAM5hAY5BdoxIlU4IaxwxFxDGEUrykKhv20UnS820W3nj4tHN4KBAPUR3rj4CODJRRSGckye30s4a6","float":0.76}}'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'an'

SQL datatype: VARCHAR(10)

Laravel SQL datatype: string(name, 10)



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'ik'

SQL datatype: CHAR(2)

Laravel SQL datatype: char('name', 2)



## phone

A phone number in E164 format

Random value example: '+8537101989414'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RUDsuCAwWvdQrrHdODsbVUJVgJQQ6G6NwM1zcfBQ6l4MMtY71BCmcKIqAHZ0j6PlhOSwR9wMuzMvXz2Gm3Kjbro'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Eveniet dignissimos voluptatem culpa nobis. Nihil fuga ut architecto qui. Aut tenetur eveniet consequuntur. Tempora aperiam assumenda corrupti fugiat.'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## time

Time (HH:MM:SS).

Random value example: '21:03:06'

SQL datatype: TIME

Laravel SQL datatype: time('name', 0)



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2020-06-09T14:42:17+0000'

SQL datatype: TIMESTAMP

Laravel SQL datatype: timestamp('name')



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Pacific/Rarotonga'

SQL datatype: VARCHAR(50)

Laravel SQL datatype: string(name, 50)



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1679616882

SQL datatype: INT UNSIGNED

Laravel SQL datatype: integer("name")->unsigned()



## url

Datatype for URLs

Random value example: 'http://spencer.com/'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 57267

SQL datatype: SMALLINT UNSIGNED

Laravel SQL datatype: smallInteger("name")->unsigned()



## uuid

Datatype for uuid values.

Random value example: '3ce18e6a-96c0-4b27-8a82-4daac1002f53'

SQL datatype: CHAR(16)

Laravel SQL datatype: uuid('name')



## year

Valid years. May create a special field in the database.

Random value example: 2090928643

SQL datatype: INT

Laravel SQL datatype: year('name')


