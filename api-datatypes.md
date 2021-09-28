
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RIRkRkyRQoPUtd'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RJkGGBe7yNPZHRY'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RD7VSxUs65SwU4'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '41.200.137/0001-77'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#AC24BF'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'PY'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'GBR'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 756



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '742.506.527-42'



## currency

Currency names, with their 3-letter codes.

Random value example: 'MYR'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2027-03-04'



## datetime

Datetimes in ISO8601 format.

Random value example: '2027-12-09T20:26:35+0000'



## domain

Internet domain names.

Random value example: 'wunsch.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'owhite@hotmail.com'



## file





## float

Floating point numbers.

Random value example: 0.916



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Omnis nihil quaerat voluptatum optio quia dolorem magnam. Omnis quis tempore aut est nostrum est. Nobis ut illum rerum.</span>Qui veritatis ut voluptas consequuntur sunt. Itaque quo debitis officia eaque minus. Perspiciatis error voluptatem totam iure et.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 568899739



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: 'c14c:a952:b161:ce98:6e70:c260:49d:6b66'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '225.196.180.111'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '6dba:769e:2187:1e70:c68c:2e6b:aafc:29a8'



## json

Valid JSON data

Random value example: '{"version":139785143,"data":{"string":"Rf3OSfYI98vj6y9D95bycNXS4JmqBLh5mKHqd35ueannNcG","float":0.627}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'to'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'ps'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Jean Streich'



## phone

A phone number in E164 format

Random value example: '+14109249452'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RjNCuDo4O5CLucUShlb4lpJBm3wDfxaZ8DDxc19cpEwzffjMMxIEmpG0DiKVr09TyWFndfyQWttycJZCjbOZrBrtOIZJqkemrP9SqiRjykUCbBxwO'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Non quo ut voluptatem ipsam amet. Sint aliquid ut quod facilis et sit quae. Et expedita totam sed omnis qui tempora quidem.'



## time

Time (HH:MM:SS).

Random value example: '16:28:16'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2025-07-19T20:50:31+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Miquelon'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1448715775



## url

Datatype for URLs

Random value example: 'https://mueller.com/necessitatibus-illum-ratione-culpa.html'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 6813



## uuid

Datatype for uuid values.

Random value example: 'f43c31db-9a03-4929-a5db-1c6cadf17fef'



## year

Valid years. May create a special field in the database.

Random value example: 1997


