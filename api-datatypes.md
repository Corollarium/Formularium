
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RMUaVIgRjn'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RAp9nY6yeK'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RTNwf4E8q58W'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '56.727.891/0001-37'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#53E01E'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'CD'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'ZAF'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 480



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '260.038.531-23'



## currency

Currency names, with their 3-letter codes.

Random value example: 'KZT'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2013-01-26'



## datetime

Datetimes in ISO8601 format.

Random value example: '2020-03-15T07:07:55+0000'



## domain

Internet domain names.

Random value example: 'pacocha.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'rico.bayer@wisozk.org'



## file





## float

Floating point numbers.

Random value example: 0.999



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Fuga aliquid soluta et ab ea ea similique dolorem. Tempora dignissimos temporibus qui consequuntur.</span>Quia sunt eaque sed. Ullam ratione voluptatibus impedit suscipit officia dolorem facilis. Quod est id aut eos incidunt. Ipsum qui commodi facilis rerum culpa aut molestiae velit.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -174888262



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '209.1.81.22'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '123.218.245.5'



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'e7b9:af60:6467:e75d:eb2a:9a87:a23:a79d'



## json

Valid JSON data

Random value example: '{"version":-942523306,"data":{"string":"RmjtjVGbr2RHgeulfakzPiHZwnIf46nOrlFN3wq4L7izvaraeeXtDmvmRlouRtCGKlfWV1BlfuWQLBvMh8n4PcOu4y3U6hg2HUGevsGb6jzv6vkJMxwhrTS2HPiAQKEcbFEOTLT6ntT8WvproLYt","float":0.103}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'ml'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'es'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Giovanna Schamberger'



## phone

A phone number in E164 format

Random value example: '+13417125902'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'R5sHUtuPr1wIJoq0uIKSudkLBcbYLGDoQEbPa7YsIX4hWPzROM5QiPyiyQweSWVRM84QV2scA3fUr3hH88tlPKJkDqYt04sVZmom3XqEuQmabvy6B9oUYtNmuMEoe4G7if1S'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Aut facilis ipsam similique maiores. Vitae sint rerum minima qui. Sint hic occaecati nam et est sint omnis. Aut aut quam magni atque qui qui. Error animi dolorem debitis minus.'



## time

Time (HH:MM:SS).

Random value example: '00:26:48'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2012-06-04T13:31:18+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Shanghai'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1898740793



## url

Datatype for URLs

Random value example: 'http://www.paucek.com/accusantium-est-itaque-et-illo-ipsam'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 55362



## uuid

Datatype for uuid values.

Random value example: 'be8f01f2-785a-4f93-9814-7a770a056790'



## year

Valid years. May create a special field in the database.

Random value example: 1993


