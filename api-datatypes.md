
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RdTeAeqze'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'R4Pay0VH9Ywwxre'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RwxFp_aLoE3pX2'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '93.584.789/0001-56'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#A8D8C2'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'UY'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'AIA'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 772



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '798.164.514-09'



## currency

Currency names, with their 3-letter codes.

Random value example: 'ALL'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2013-11-13'



## datetime

Datetimes in ISO8601 format.

Random value example: '2011-10-20T20:44:14+0000'



## domain

Internet domain names.

Random value example: 'schneider.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'mbrown@hotmail.com'



## file





## float

Floating point numbers.

Random value example: 0.307



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Temporibus iste voluptatem consectetur nam vel repellat delectus. Maiores a libero possimus accusantium. Ea atque ut nisi omnis est. Et veniam est ut.</span>Doloremque dolorem dolorem qui consectetur illum. Et quidem in nemo eaque impedit.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 1140074618



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: 'b491:3121:9be5:eb37:a3ad:e29e:c3af:2e75'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '21.29.213.246'



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'ad72:b0d0:a136:4380:796e:a865:58be:cdee'



## json

Valid JSON data

Random value example: '{"version":-382226528,"data":{"string":"RfDgy6L7epDwCLQm70ylJLVxLFLFWQbQZPPidlUIqgjBRqbqvmP4I8cUsopRwU0TKKwamUh7dL9qmzIrleOUtfQtgVDupLtpo3poXLYBwltP2p8GkaQZHzxOEnBCX8qyuYc3cVnlyiuBSdSW5nPBO94LXtIY704JRFCmoAXv2b6ZsuURJiGgN20A6LniY29XclLBtUnJh4u56uByaU4JMUsHVcyW","float":0.611}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'be-tarask'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'de'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Arlie Reichert'



## phone

A phone number in E164 format

Random value example: '+13235103112'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'R1FiSSvVl1fNyU66ng4uX1Wv6L'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Atque voluptatem quam aliquid est fuga illum soluta dolorem. Molestias earum ipsum aspernatur explicabo nobis aut. Corporis porro ut qui quo.'



## time

Time (HH:MM:SS).

Random value example: '21:19:39'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2014-07-01T01:00:07+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Recife'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 2398051083



## url

Datatype for URLs

Random value example: 'http://romaguera.org/voluptatibus-pariatur-in-eum-quo-ab'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 23835



## uuid

Datatype for uuid values.

Random value example: '9fa181ae-3414-4e1e-9fe2-a126537093eb'



## year

Valid years. May create a special field in the database.

Random value example: 1997


