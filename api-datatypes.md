---
parent: Reference
nav_order: 1
---

# Datatype Reference

List of datatypes and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RZTOCPdeHU'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'Rjih2O'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RsGJUk_Sowja_'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '68.029.166/0001-74'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#1177AD'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'BD'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'MEX'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 288



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '918.129.319-48'



## currency

Currency names, with their 3-letter codes.

Random value example: 'BGN'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2017-11-10'



## datetime

Datetimes in ISO8601 format.

Random value example: '2023-12-26T16:21:16+0000'



## domain

Internet domain names.

Random value example: 'mckenzie.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'sierra32@gmail.com'



## file





## float

Floating point numbers.

Random value example: 0.484



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Ipsa tempore repudiandae et ut aut. Ea natus placeat quam necessitatibus asperiores. Et culpa dolorem voluptas magni voluptate incidunt nesciunt quia. Et ut dolor sint sapiente officia explicabo.</span>Ut inventore reiciendis voluptatem quam. Id perferendis aut voluptatem assumenda consequuntur sed id. Voluptates similique itaque qui perspiciatis. Sit corporis corrupti aut recusandae nobis.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 973614157



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '161.14.233.138'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '200.229.55.174'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '9d9b:b5ea:bed9:8981:4762:e151:3163:97b0'



## json

Valid JSON data

Random value example: '{"version":-1345548882,"data":{"string":"R3UI0dGRLqTTMj8dlCFviUF1YlPbBAov02nEhw3f91rrWWschTFglVTx9D6sw9kWnuBhwbkcp5tXlFOohVmaQY3UBNs6HzaGnfhVOebkQT0q4i1gNlXQSkc9EpvIcjeuuSq","float":0.992}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'ca'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'kr'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Dr. Reba Hoppe DVM'



## phone

A phone number in E164 format

Random value example: '+19898218117'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RVJMlMPWzSEq7c5QgrrdtAOm5NBs9uOXoS4ogy4RphDLjEzPpPccstFAQbruVAYYojZeUp6PpFsZYk5px'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Id similique dolore culpa laboriosam ducimus. Quae officia aut autem id et. Sunt ab eum repellendus quis. Ut quis non veritatis cupiditate laudantium ut id modi.'



## time

Time (HH:MM:SS).

Random value example: '12:54:26'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2031-04-25T16:43:31+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Detroit'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 62532056



## url

Datatype for URLs

Random value example: 'http://www.bogisich.com/sed-repellendus-ratione-blanditiis-veritatis-odio.html'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 21302



## uuid

Datatype for uuid values.

Random value example: '5bb6f951-f2ab-42cb-8acd-0c98e4222192'



## year

Valid years. May create a special field in the database.

Random value example: 1994


