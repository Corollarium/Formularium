
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RbeSWQwMxAGzZXR'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RJJhV5'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RRpHmwNzNGDSx'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '95.570.973/0001-72'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#65768F'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'MH'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'NIU'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 702



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '090.282.874-69'



## currency

Currency names, with their 3-letter codes.

Random value example: 'AZN'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2019-02-10'



## datetime

Datetimes in ISO8601 format.

Random value example: '2016-05-29T22:19:38+0000'



## domain

Internet domain names.

Random value example: 'schamberger.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'naomie.goodwin@lubowitz.com'



## file





## float

Floating point numbers.

Random value example: 0.385



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Voluptas natus repudiandae nulla magnam. Quam enim veritatis magnam recusandae id hic ratione accusantium. Architecto voluptatem ut officiis amet. Sit rem debitis dolores et placeat blanditiis iste.</span>Aut nihil modi cumque. Qui quidem doloribus et amet architecto enim. Fugiat distinctio ad saepe soluta praesentium necessitatibus excepturi. Est sequi totam quibusdam modi magni tempore.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -390201150



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '102.48.199.170'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '108.1.4.155'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '9bf0:e694:5561:d15b:5431:b56a:bb29:78f'



## json

Valid JSON data

Random value example: '{"version":-688335178,"data":{"string":"R59Uho8Dw0qfpzbBU6h80nt9E0YDvplr7DgsWOnxz4QYPvxVa52osLKwfBjXj7TkNx9cv3WlVnmRsnmV12Ly1uipCSpFXJof9gQm5Gz2XzgVCL6cZ36ZqEzbPigiIjHc0gLd4HB0fyQUS8dbxPP0DqA1CdoHgepztWB7HNYSaXv7OWYi4XwFXpcvayA7ORkk2Zl6YIAzIYQ89kOo0KOGCQV9vJSQTGCxNvDRQriM7lzSn0XR","float":0.052}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'ch'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'om'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Ms. Ottilie Runte'



## phone

A phone number in E164 format

Random value example: '+18436583026'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RooxrRQqb72ern1hN9QNoZsS8TPCnmhGxygjLbXQkHzgfoqTL0Qj2Jqr1k8PJbo6stlC9tE6VLvCCSqxwM1EnPttHRbaNwXDB4OQEzRZ5wKsKVBFBEuIzhCWn7keAZQl6vNqeOI48PybUrBiy'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Velit voluptatem accusantium nostrum esse ut qui inventore. Amet aspernatur modi autem pariatur distinctio exercitationem. Quibusdam fugit ut omnis totam non fuga.'



## time

Time (HH:MM:SS).

Random value example: '14:34:45'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2013-09-11T03:00:15+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Africa/Asmara'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 4145681132



## url

Datatype for URLs

Random value example: 'http://www.williamson.com/'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 41301



## uuid

Datatype for uuid values.

Random value example: 'b1f32af4-9388-4752-8e50-bf9b82822934'



## year

Valid years. May create a special field in the database.

Random value example: 2005


