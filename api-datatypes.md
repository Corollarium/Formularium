
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RAhiFVhj'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RhcZsGpRC5xZU2d'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RU0Rzr'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '27.947.765/0001-90'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#65BC6A'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'IQ'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'SJM'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 324



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '869.040.196-20'



## currency

Currency names, with their 3-letter codes.

Random value example: 'COP'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2011-10-06'



## datetime

Datetimes in ISO8601 format.

Random value example: '2026-12-13T01:19:25+0000'



## domain

Internet domain names.

Random value example: 'mills.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'hyatt.ashlee@yahoo.com'



## file





## float

Floating point numbers.

Random value example: 0.106



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Ad nobis est aperiam impedit eos nobis repellendus quia. Voluptas qui laudantium id nemo fugit voluptatem. Dolorum beatae sapiente officia eos rerum quos nobis. Quia veritatis eos qui id natus.</span>Sit nisi cupiditate necessitatibus. Necessitatibus mollitia minus ullam adipisci. Laudantium neque vel ut aliquid sed aut mollitia.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -796359524



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '87.30.241.62'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '247.41.180.133'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '916d:6323:836a:23c0:ddeb:ef33:4df5:8416'



## json

Valid JSON data

Random value example: '{"version":2064691178,"data":{"string":"R13mf7YhwA5gwJNoiGrZ1YTfiPNNmL85U66oOl18v19GqpJbhHnfF36dq0rLfQpIrFzUlFkBlrBw37FZ0Ago3bWLAoD2wMWh8vp8SikMpAEyBggn7R8b9OcM4r4P1kA9dGphmTp8CrIhe08JX6n6iSfrqVTuJmIk7htljIx01DqNy347fx9HtmWyiekTepjC7fnXue2N6Vu5jzOA0wxJV5cgK1PvRkbnQ8PnmzqKtV9CHJD51","float":0.632}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'kg'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'ku'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Krista Leuschke MD'



## phone

A phone number in E164 format

Random value example: '+17701310580'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RtHus7QDsmWDgZoXOPzxhRg7wHuFuQAL0pcrkTdGbG4VBpVZ39d2MWlt8QPe6KMazrb83xELtwZXkJuGfwWH4xJyIl32opfH7d6yeMl1HM1CWPbbGd9odLvu1RJSyuTBAZFVlnmygmdpSXODj944QJJTQcD04ePzG3oJ6mQ4wwpcia05Hwm7Mk1ft7D3fCE861ir'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Ea et consequatur incidunt sed est explicabo. Deleniti dolorem quaerat aut esse hic vel adipisci odit. Omnis rem voluptate et. Quam beatae nisi velit molestias enim.'



## time

Time (HH:MM:SS).

Random value example: '15:14:19'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2028-09-05T05:53:06+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Africa/Khartoum'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 2152224296



## url

Datatype for URLs

Random value example: 'http://www.kling.info/'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 14352



## uuid

Datatype for uuid values.

Random value example: '3d1829b9-ac41-420c-aa7c-961042a9f473'



## year

Valid years. May create a special field in the database.

Random value example: 2005


