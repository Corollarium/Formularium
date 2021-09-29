
---
parent: Reference
nav_order: 1
---

# Datatype Reference

List of datatypes and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RPAGhK'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RWkbefoHD'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RK8DJ'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '72.508.842/0001-60'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#26D40D'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'BI'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'BHR'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 430



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '294.651.060-38'



## currency

Currency names, with their 3-letter codes.

Random value example: 'ERN'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2029-07-21'



## datetime

Datetimes in ISO8601 format.

Random value example: '2030-11-23T06:09:38+0000'



## domain

Internet domain names.

Random value example: 'balistreri.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'norberto60@gmail.com'



## file





## float

Floating point numbers.

Random value example: 0.559



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Dicta magni magni nihil perspiciatis amet. Commodi excepturi et reprehenderit qui vero. A eum et provident id. Dicta maxime esse debitis nisi et modi.</span>Esse sed porro deserunt aspernatur porro. Velit ipsam ad qui aut aut earum. Id dolorum aut magni blanditiis doloremque voluptas et. Eaque laborum sint porro.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -698613638



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: 'f976:49a9:16ed:73bc:f0e2:9cf8:c829:79e6'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '71.170.47.238'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '2671:9ede:e102:659a:f17a:8e5f:bd35:5763'



## json

Valid JSON data

Random value example: '{"version":-1770981365,"data":{"string":"Rrmk95ufnoqhXzgHpkGVrDqNBzuNFKAUzBBEhdjfQvkFPGZBlO92VMzGBb2eJPUsTPG5NVvwZm3fKdrT0Fyto7ubvufA7jTpZ7VqmZKrJ2f4ZVFNqbwxYgfJuZC22LyE2CizxaxGnwIsArnJSTcYRMZ5KA8vbsmiLVhT4Z","float":0.383}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'am'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'yo'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Mrs. Isabell Ryan II'



## phone

A phone number in E164 format

Random value example: '+12548621678'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RybS5jtbl0AhNQqLq3X8aZJ0AttdndTT0wimHJpqtknhhP6oh26f0Htt6qI8i2TEkC5EVFqv06rwrVQHxqZ6gksdXhDrhrNfCpxJyU74GLHMHxP8W9v8jfzEjlM38NSWww6k9wnFdduDBHdr9xoVcuYwYrwBIwRE7fWWKqraZcNBHCwSncJh6BZMsdonLqima43dVUolWP0LoasIF'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Facilis molestiae rerum quos saepe debitis. Et consectetur consectetur aliquid ipsam. Quia voluptatum odit nulla qui.'



## time

Time (HH:MM:SS).

Random value example: '01:27:05'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2029-03-13T14:19:48+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Chihuahua'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 3534931632



## url

Datatype for URLs

Random value example: 'http://www.emard.com/'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 56032



## uuid

Datatype for uuid values.

Random value example: '7831f426-8533-4a40-bbb7-c2692f9694b8'



## year

Valid years. May create a special field in the database.

Random value example: 1994


