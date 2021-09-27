
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RpiFVMRKTSqA'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'R7k22isyWxIh'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RBt-IzNnBfcM'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '92.857.064/0001-21'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#6593C1'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'LS'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'FSM'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 652



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '418.491.108-08'



## currency

Currency names, with their 3-letter codes.

Random value example: 'TRY'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2024-02-08'



## datetime

Datetimes in ISO8601 format.

Random value example: '2018-11-09T04:28:48+0000'



## domain

Internet domain names.

Random value example: 'hessel.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'adavis@hotmail.com'



## file





## float

Floating point numbers.

Random value example: 0.68



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Eligendi aspernatur itaque nam repellat adipisci dicta autem quibusdam. Suscipit veniam assumenda quidem eaque dicta. Incidunt similique consequatur veritatis autem excepturi impedit.</span>Occaecati numquam asperiores laudantium harum. Explicabo ut quos ipsa incidunt. Dolore corrupti voluptatem omnis natus.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -60938889



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: 'a7e6:5047:1306:a8e:7dd6:b3a9:833e:6776'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '43.77.61.250'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '1af3:85e6:fea0:e720:4005:598d:da5f:29cf'



## json

Valid JSON data

Random value example: '{"version":866451871,"data":{"string":"RaAp0EQF4v4","float":0.829}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'eu'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'mr'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Rhianna Schuster'



## phone

A phone number in E164 format

Random value example: '+19387013645'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RP0GnwqiKvvXDARFvSCjZuV9bply8YjXGj3sM4Qzq8a72H5qp8PCeHEx2TS2GGE6fIvnOGbkgctAsJshtMsmxMqgMNJefjV3H7IsR9fSoeggMIDHKvqjlhBD3nGrhZGjgjn6nkkh1cqwW8MaN'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Odio deleniti aut ad at perferendis. Fugiat culpa dolorem perspiciatis cupiditate tempore.'



## time

Time (HH:MM:SS).

Random value example: '09:36:09'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2020-01-24T19:02:12+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Thimphu'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 4212061106



## url

Datatype for URLs

Random value example: 'http://www.bosco.net/molestias-aliquam-autem-corporis-labore-non.html'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 18982



## uuid

Datatype for uuid values.

Random value example: '0333afae-04fb-468d-82e8-057ce9b19c84'



## year

Valid years. May create a special field in the database.

Random value example: 1999


