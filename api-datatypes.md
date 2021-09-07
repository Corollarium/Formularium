
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RcmHfnZKEfkvpb'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'R3LfeIwndp3ox'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RSSg1AOBy'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '20.275.027/0001-02'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#AB28E6'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'UA'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'BTN'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 710



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '921.750.643-52'



## currency

Currency names, with their 3-letter codes.

Random value example: 'IDR'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2025-08-13'



## datetime

Datetimes in ISO8601 format.

Random value example: '2030-03-25T08:22:31+0000'



## domain

Internet domain names.

Random value example: 'heller.biz'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'guido67@monahan.com'



## file





## float

Floating point numbers.

Random value example: 0.981



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Omnis qui tempore quia vel unde quo. Quos ullam quia molestiae quis molestiae similique. Assumenda atque deleniti pariatur.</span>Hic ab repudiandae quos velit numquam eum mollitia. Est ea esse eos ut error nemo. Repudiandae et illum sed sit laudantium accusamus sunt.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 1190373398



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '5780:c4a2:9826:1a7f:aecf:9e2e:3d5b:15b7'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '241.181.113.159'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '7b2c:2256:c1b3:abb2:934f:c107:49ff:b631'



## json

Valid JSON data

Random value example: '{"version":-1580342034,"data":{"string":"RgVFPHp2aYwXixZz3T84DmzEmOJBKfAtQLBCOovTz0wIhQEygfuTVRWjGI8cijDrQsWWGfmALSkWr5NxbuJDHI9VI1pMSwGD4XcAcz1agcQoacPr3qYLaR0jorrAupZ6JvfCRbQxgAXbm5e1pXD62QMeIYt1s4zcg7UOTYZBdnhSCDI8wLk1Ueh7JWQbxIgc","float":0.567}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'pms'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'ja'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Elise Walsh'



## phone

A phone number in E164 format

Random value example: '+12540389192'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RxInEYtlqHmuZiQSPWSD0MSNtGCYsr1V6sKK4q4WjdkWAZie6YbCrhJZKgC7BF6XrfqaypVp9C5UvBMp4QxMW1YOSIey5KQZfPShv9gLNJpTh5Xxzq1o7b7IGE'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Voluptates quia reprehenderit maxime eaque et autem molestias. Dolor quasi ducimus dolores officiis ab id voluptatem.'



## time

Time (HH:MM:SS).

Random value example: '19:55:00'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2013-03-20T07:54:40+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Europe/Kiev'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1242921227



## url

Datatype for URLs

Random value example: 'https://haag.biz/dolor-ea-ut-omnis-ab-dolorem.html'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 43061



## uuid

Datatype for uuid values.

Random value example: '7e3cd08e-8e9a-4888-a826-ff12a9a01f16'



## year

Valid years. May create a special field in the database.

Random value example: 2015


