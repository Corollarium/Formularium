
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RdyIqcwh'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RmIpn'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RPx4PCb'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '63.116.685/0001-56'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#836610'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'AG'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'ALA'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 634



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '670.744.365-85'



## currency

Currency names, with their 3-letter codes.

Random value example: 'LYD'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2013-10-14'



## datetime

Datetimes in ISO8601 format.

Random value example: '2027-04-26T12:57:49+0000'



## domain

Internet domain names.

Random value example: 'balistreri.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'marlene97@yahoo.com'



## file





## float

Floating point numbers.

Random value example: 0.6



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Iure quae ipsum cupiditate consequuntur qui facere aliquid. Veniam iure necessitatibus culpa et error. Illo atque ut voluptatem.</span>Aut qui eum velit et perferendis. Ut et provident sed debitis. Quidem et vel libero amet. Fugiat qui accusamus enim dignissimos et qui sed. Delectus ea nemo accusantium aliquid.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 1861820405



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '138.230.231.161'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '64.174.170.87'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '1d6e:24cb:4fad:d4fe:dd9f:b519:544:8086'



## json

Valid JSON data

Random value example: '{"version":-121639595,"data":{"string":"RhU9IqQQo0WVhQBF8AHYVgkQdlWijej0zXliuwwzeLu8Qbeoqo08PbvzCasDwjjAOEBAUuIIGj8N","float":0.202}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'nah'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'sv'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Gladyce Walter'



## phone

A phone number in E164 format

Random value example: '+15124718136'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RFr7vurXABrpd7liRKnSp2Y0kRArZwkfP0e5C07vBnfv0MJcI4ZvZD1s6VSSIFHF5CkxGkloYjK8roLsoOFihrFd7kZJMCSECdQxUxzL7T'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Velit eos accusamus aut consequatur totam. Nam dolores at rerum nobis fugit. Similique sit dicta adipisci sunt esse earum.'



## time

Time (HH:MM:SS).

Random value example: '05:57:49'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2019-05-26T09:44:25+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Bangkok'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 740128926



## url

Datatype for URLs

Random value example: 'https://www.gislason.com/voluptatem-et-est-id-vitae-totam-totam'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 52386



## uuid

Datatype for uuid values.

Random value example: '88313be7-af61-4bde-90b8-e5dd8d2ee66f'



## year

Valid years. May create a special field in the database.

Random value example: 2017


