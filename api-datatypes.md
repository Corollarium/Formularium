
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'Ricvdaqk'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RdKfG5soz'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RVNNJw8K2S'

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

Random value example: '52.993.171/0001-62'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#AB874B'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'OM'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'TCD'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 376

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char('name', 3)`



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '850.242.501-33'

SQL datatype: `VARCHAR(13)`

Laravel SQL datatype: `string(name, 13)`



## currency

Currency names, with their 3-letter codes.

Random value example: 'BBD'

SQL datatype: `CHAR(3)`

Laravel SQL datatype: `char(name, 3)`



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2024-09-26'

SQL datatype: `DATE`

Laravel SQL datatype: `date('name')`



## datetime

Datetimes in ISO8601 format.

Random value example: '2023-08-22T21:40:20+0000'

SQL datatype: `DATETIME`

Laravel SQL datatype: `datetime('name')`



## domain

Internet domain names.

Random value example: 'klocko.com'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'valentina66@gmail.com'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## file





## float

Floating point numbers.

Random value example: 0.101

SQL datatype: `FLOAT`

Laravel SQL datatype: `float('name')`



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Omnis totam voluptates dolorem explicabo qui provident velit et. Consequatur consequuntur quia voluptatem aliquid.</span>Aliquid aspernatur veniam est ratione odio eum est. Omnis laudantium excepturi quos quae doloribus a repellendus. Culpa sapiente labore ea eos suscipit rerum. Unde aut fugit non rerum sint.</p>'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 1413195216

SQL datatype: `INT`

Laravel SQL datatype: `integer("name")`



## ip

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'fbc1:9a2b:2592:58f7:2323:3720:599c:11f9'

SQL datatype: `VARCHAR(39)`

Laravel SQL datatype: `ipAdddress('name')`



## ipv4

Datatype for IPs in IPV4 format

Random value example: '71.120.167.167'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## ipv6

Datatype for IPs in IPV6 format

Random value example: '7dc8:c2df:ca13:e9ea:d396:c949:15c5:890a'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## json

Valid JSON data

Random value example: '{"version":-1535056355,"data":{"string":"RPnLL4lquInLyBYxB1G0RKBPVCDjz7EaEm43IoAJKOMs4ieFJETJOH9EPNwi9lRaABWiQXu7HEGp3j6cygOhH4teWEuLJnicsPBk9DquGgPyTVVedhjexDmxe1v3VtFdu0YPBKfR8EBJJme857CSdNV1OVV75","float":0.449}}'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'pt'

SQL datatype: `VARCHAR(10)`

Laravel SQL datatype: `string(name, 10)`



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'ch'

SQL datatype: `CHAR(2)`

Laravel SQL datatype: `char('name', 2)`



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Arlie Swaniawski'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## phone

A phone number in E164 format

Random value example: '+6367306952760'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RlXtpkIDMIx5Ex1guxFuIBagw3HbfjY4XiR1aN8eltlqZbBWNwWOlb5yxDjPqqRtaSynfQh9CAfU0UWS2rP2virRlHhuB014jZz39ghlqfMdXp33p2n9O4bkokfyGtpl5itLYEIZCpJmv3eXdYAoi6siLqCO8ty3OziUj9mjkJLTicW5ItCbG7ixDU5fNAVKEHK5vjP8sd7vkRQL5Tj3CeFqkDs8yXB7bOkm4KJufnnUBDI1fG'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Et facere fugit voluptatem. Sunt ut praesentium sequi. Nobis dolorum consectetur voluptatem molestias aperiam. At qui quisquam rem.'

SQL datatype: `TEXT`

Laravel SQL datatype: `text('name')`



## time

Time (HH:MM:SS).

Random value example: '23:52:11'

SQL datatype: `TIME`

Laravel SQL datatype: `time('name', 0)`



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2016-05-28T18:11:13+0000'

SQL datatype: `TIMESTAMP`

Laravel SQL datatype: `timestamp('name')`



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Famagusta'

SQL datatype: `VARCHAR(50)`

Laravel SQL datatype: `string(name, 50)`



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1996847184

SQL datatype: `INT UNSIGNED`

Laravel SQL datatype: `integer("name")->unsigned()`



## url

Datatype for URLs

Random value example: 'http://www.yundt.com/nemo-delectus-itaque-quibusdam-facere-expedita-eaque-eligendi'

SQL datatype: `VARCHAR(256)`

Laravel SQL datatype: `string('name', 256)`



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 49624

SQL datatype: `SMALLINT UNSIGNED`

Laravel SQL datatype: `smallInteger("name")->unsigned()`



## uuid

Datatype for uuid values.

Random value example: '5bf04670-e46e-456d-9044-b425ad421992'

SQL datatype: `CHAR(16)`

Laravel SQL datatype: `uuid('name')`



## year

Valid years. May create a special field in the database.

Random value example: 2014

SQL datatype: `INT`

Laravel SQL datatype: `year('name')`


