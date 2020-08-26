
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RVIWIPhwQpfKJR'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RI5u9Jazxpgf'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RZ1hv0qNn-NR'

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

Random value example: '51.052.595/0001-60'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#EAF65F'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'ZR'

SQL datatype: CHAR(2)

Laravel SQL datatype: char('name', 2)



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'PLW'

SQL datatype: CHAR(3)

Laravel SQL datatype: char('name', 3)



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 666

SQL datatype: CHAR(3)

Laravel SQL datatype: char('name', 3)



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '901.354.905-53'

SQL datatype: VARCHAR(13)

Laravel SQL datatype: string(name, 13)



## currency

Currency names, with their 3-letter codes.

Random value example: 'SLL'

SQL datatype: CHAR(3)

Laravel SQL datatype: char(name, 3)



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2022-10-26'

SQL datatype: DATE

Laravel SQL datatype: date



## datetime

Datetimes in ISO8601 format.

Random value example: '2014-11-06T16:11:52+0000'

SQL datatype: DATETIME

Laravel SQL datatype: datetime('name')



## domain

Internet domain names.

Random value example: 'cronin.com'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'clindgren@hotmail.com'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## file





## float

Floating point numbers.

Random value example: 0.404

SQL datatype: FLOAT

Laravel SQL datatype: float('name')



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Quibusdam voluptas deserunt suscipit doloremque. Odit esse qui laborum nihil esse rem. Labore error blanditiis illo sed ea.</span>Nam modi nulla suscipit. Ad eligendi dolore facilis qui et. Quia quis ipsa veniam error. Voluptatem corporis impedit porro odit quidem earum velit. Aut alias possimus enim enim distinctio at et.</p>'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -803770407

SQL datatype: INT

Laravel SQL datatype: integer("name")



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: '83.9.55.51'

SQL datatype: VARCHAR(39)

Laravel SQL datatype: ipAdddress('name')



## ipv4

Datatype for IPs in IPV4 format

Random value example: '97.170.132.29'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## ipv6

Datatype for IPs in IPV6 format

Random value example: '3c37:a595:b42e:c6a4:2754:a609:5cbd:c9c8'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## json

Valid JSON data

Random value example: '{"version":-714258960,"data":{"string":"RMuISdogk6o5rupI4hmxXuvx1vNif4UEViN251l7KGLljGhnRR3xG12XkjGqqNcECmeoMNdGVjBpmLzopyHDS9CnPISoWvvVTPWD5ZzI250379dHwaUTnxbb9R6fYdfcE0ic","float":0.745}}'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'bs'

SQL datatype: VARCHAR(10)

Laravel SQL datatype: string(name, 10)



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'kj'

SQL datatype: CHAR(2)

Laravel SQL datatype: char('name', 2)



## phone

A phone number in E164 format

Random value example: '+8803034829904'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RgGOsjyjMgG2pIUUQgxcN88JL6THH6pPiyAE1HT4Z3TrSGCClooaS6Dr381FTOxvpAH1DpDT0Z0YuFaEaYPgZa1UjNhD4hSfXZk9kHSbMDCL8oiHDeGR1wpkAbsy0jStdIq28Q1WBTOOC2b0zYVtwpdTYQ8Dy6UKsihQvLRtNckdhZUUzwN2l7CClzfM4q3Tt9DK4ftzTVKVYDZWQH8RYR1el114ASgzNWrdCFyXQbgqheAJKDHraJO'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Fuga architecto aut ullam voluptas repellat quaerat quia unde. Voluptatum commodi dignissimos sit neque mollitia. Harum reprehenderit quo nihil nihil sed. Et qui hic ducimus aut aut aliquam amet.'

SQL datatype: TEXT

Laravel SQL datatype: text('name')



## time

Time (HH:MM:SS).

Random value example: '07:50:21'

SQL datatype: TIME

Laravel SQL datatype: time('name', 0)



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2016-01-31T02:34:09+0000'

SQL datatype: TIMESTAMP

Laravel SQL datatype: timestamp('name')



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Asuncion'

SQL datatype: VARCHAR(50)

Laravel SQL datatype: string(name, 50)



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 3951881103

SQL datatype: INT UNSIGNED

Laravel SQL datatype: integer("name")->unsigned()



## url

Datatype for URLs

Random value example: 'http://www.corwin.com/ipsum-et-eos-et'

SQL datatype: VARCHAR(256)

Laravel SQL datatype: string('name', 256)



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 29780

SQL datatype: SMALLINT UNSIGNED

Laravel SQL datatype: smallInteger("name")->unsigned()



## uuid

Datatype for uuid values.

Random value example: '860b79f8-ce34-40c2-9f11-ede2cd60a653'

SQL datatype: CHAR(16)

Laravel SQL datatype: uuid('name')



## year

Valid years. May create a special field in the database.

Random value example: -1348297737

SQL datatype: INT

Laravel SQL datatype: year('name')


