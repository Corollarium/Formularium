
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RaVpeYzAU'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'R449ghjU09mD'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RsmprEkdI9p5n'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '39.672.560/0001-28'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#429413'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'CM'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'MAC'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 340



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '613.031.947-91'



## currency

Currency names, with their 3-letter codes.

Random value example: 'QAR'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2030-06-19'



## datetime

Datetimes in ISO8601 format.

Random value example: '2024-06-21T00:02:24+0000'



## domain

Internet domain names.

Random value example: 'gleichner.net'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'imogene20@kuhic.info'



## file





## float

Floating point numbers.

Random value example: 0.387



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Rerum aliquid quibusdam enim officiis voluptatem. Molestiae et et non totam est inventore quisquam. Consequatur aut nesciunt eaque aliquid.</span>Eius eveniet necessitatibus commodi recusandae. Ex vero aspernatur dolores. Amet error cupiditate id aperiam. Id ut qui omnis cum quam.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -1927165031



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '939b:9d8d:6caf:cf21:7acd:c417:90c2:a3b4'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '166.101.198.249'



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'a55:5de1:120b:4526:1001:3381:d7d7:d85f'



## json

Valid JSON data

Random value example: '{"version":-1371024913,"data":{"string":"Rc4c4BsohO8nCv184eeSmhbi513MtEBG2MkbaaP3SxZScsbneonf5QbpXFI81MaApzWdbRT2solYjEZr6Ai7c4xLKRQWyy7vSb6PptWCQfu0CQmnLdYbCLtCpx0cPJodn0v0GZww8LznKg6RFRf0bPfz7bLc3UlWL2YY","float":0.307}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'be-tarask'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'km'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Cruz Lynch'



## phone

A phone number in E164 format

Random value example: '+14172341863'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RW46jZgqf8kJ3n0mSLa92YAUXAJJG1SXbbqMMiRDyNjKtUPnKvUtwTQirdnrcOOWxA2DmJ4fg50OaIwDRvAsE4QOPKZ0pH0MNA2plxKXofHKyPRQfRengJziZC3NLf0BtFEMj9ce9RPsqAIJgKrkzZE6SUbCiHhIFJkSMRp5gGiy'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Corrupti sit quo sint corporis et. Reprehenderit nesciunt aliquam repellat provident quaerat cupiditate. Consequatur dignissimos nemo est doloribus ut impedit deserunt.'



## time

Time (HH:MM:SS).

Random value example: '00:30:42'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2011-12-01T05:21:43+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Cayenne'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1253267300



## url

Datatype for URLs

Random value example: 'http://abernathy.com/'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 22907



## uuid

Datatype for uuid values.

Random value example: '272ad77e-2cbb-43e1-a2d4-14b281e94311'



## year

Valid years. May create a special field in the database.

Random value example: 2016


