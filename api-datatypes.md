
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RTOEhBsWOerhvj'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RZwcdRipzmAcw'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RmdD651aGzLs0oM'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '99.149.324/0001-53'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#07B5DE'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'ST'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'GNQ'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 364



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '114.425.452-32'



## currency

Currency names, with their 3-letter codes.

Random value example: 'DJF'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2021-02-22'



## datetime

Datetimes in ISO8601 format.

Random value example: '2023-07-17T01:36:27+0000'



## domain

Internet domain names.

Random value example: 'bogisich.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'elyssa.cole@hotmail.com'



## file





## float

Floating point numbers.

Random value example: 0.508



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Enim quisquam sequi aut quasi. Veritatis assumenda officiis quisquam voluptatem quasi. Expedita tenetur omnis ea et praesentium laborum.</span>Id suscipit ipsa et vel ex praesentium. Quia iste vel quas voluptas. Et magnam harum quod amet. Enim ducimus culpa earum placeat qui consequatur.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 2019587886



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '36.213.219.135'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '15.137.25.225'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '179f:a9ca:7c56:d984:7f0:cc93:1f30:6604'



## json

Valid JSON data

Random value example: '{"version":1132385993,"data":{"string":"RJUuAp9LKbCKv0gWAOiSokl6qupBVxFyMHtvRU3","float":0.499}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'ba'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'sq'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Reyes Durgan'



## phone

A phone number in E164 format

Random value example: '+16235210475'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'Reccj34ILW4M9V7JieFt1remF2W9quK8t3LKh32JSqnrleZMTu2IhCUZtNOD4O097imVjeaFEhL3wt41sjn6ttCuht7SPbXnWcpuryPQe5pSic893iqMIxI9Fjav9tHZP0JGilvIPxtb2IhUVRSzL3c'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Earum nemo temporibus laudantium. Et deleniti eum dolores et voluptatem aliquam sed. Iste quidem ratione dignissimos qui. Ut maiores accusamus quaerat corrupti quae nisi veritatis.'



## time

Time (HH:MM:SS).

Random value example: '20:12:53'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2025-07-07T21:09:50+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Pacific/Chuuk'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 2792008107



## url

Datatype for URLs

Random value example: 'https://haag.info/eligendi-et-et-fugit-possimus-natus.html'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 10925



## uuid

Datatype for uuid values.

Random value example: '66253c54-247f-41d6-977a-f684f50ae6c3'



## year

Valid years. May create a special field in the database.

Random value example: 2015


