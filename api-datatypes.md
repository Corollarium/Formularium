---
parent: Reference
nav_order: 1
---

# Datatype Reference

List of datatypes and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RMxkpeKTedTinX'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'R96Kju'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RhVtC-SCU'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '22.927.828/0001-22'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#D84BF6'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'SY'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'BDI'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 858



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '038.156.486-02'



## currency

Currency names, with their 3-letter codes.

Random value example: 'GTQ'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2024-11-03'



## datetime

Datetimes in ISO8601 format.

Random value example: '2023-07-03T07:58:12+0000'



## domain

Internet domain names.

Random value example: 'schulist.org'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'deonte72@hotmail.com'



## file





## float

Floating point numbers.

Random value example: 0.801



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Enim iure ipsa voluptatem est dolores sit quam. Nobis commodi magni corporis natus dolor quod. Et quia harum ut.</span>Dicta consectetur corporis rerum ut quia et qui. Dolore suscipit quo nihil natus quisquam porro. Quo at sequi et illum dolores. Et nemo et et aut voluptatum aut.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 2038946749



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '188.21.91.24'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '132.146.49.98'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '6408:19b:92d3:51bc:640e:b94c:fbf:999e'



## json

Valid JSON data

Random value example: '{"version":-306303349,"data":{"string":"RG9SI","float":0.081}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'rw'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'bm'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Mathilde Sawayn Sr.'



## phone

A phone number in E164 format

Random value example: '+19370341783'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RVEy1orGNDjo8oPzXcQpE3S1SFCSmjm8LtvRjwJvzVzX34TshVfJwO'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Est aut similique id repellendus. Doloremque explicabo dolores reprehenderit quam officia amet consequatur. Et tenetur sint odit rem voluptatem rerum. Quod repudiandae explicabo eius excepturi.'



## time

Time (HH:MM:SS).

Random value example: '03:03:30'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2028-06-25T18:36:45+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Omsk'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1357959525



## url

Datatype for URLs

Random value example: 'https://sporer.net/aspernatur-voluptatibus-iste-quo.html'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 5973



## uuid

Datatype for uuid values.

Random value example: 'ddd4ad89-5a9c-418e-b68d-67355918a8e4'



## year

Valid years. May create a special field in the database.

Random value example: 1991


