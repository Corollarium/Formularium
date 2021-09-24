
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RXTxeoSmO'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RdPe2MW4mkZpQ1m'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RuGMxuJ5KzjHN'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '30.293.176/0001-40'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#1974B8'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'CD'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'BGR'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 388



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '587.517.484-60'



## currency

Currency names, with their 3-letter codes.

Random value example: 'JOD'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2012-03-20'



## datetime

Datetimes in ISO8601 format.

Random value example: '2012-12-04T10:54:47+0000'



## domain

Internet domain names.

Random value example: 'hyatt.biz'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'lavina04@veum.biz'



## file





## float

Floating point numbers.

Random value example: 0.936



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Ipsa inventore voluptatum odit error omnis optio quibusdam enim. Molestiae repudiandae quia quisquam et. Corporis nam qui quasi minima.</span>Consectetur expedita accusamus neque quisquam repellendus labore dolorem. Sed eos sunt nihil repellendus aut aut. Tenetur at fugit fugiat possimus.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 2006548204



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '7c:60b:83e2:8673:e270:d993:bb75:c352'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '211.24.45.163'



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'ad4f:650:1e20:3c04:5cc8:1587:6945:7991'



## json

Valid JSON data

Random value example: '{"version":135149940,"data":{"string":"Rbq3tyxYwLtKD6JFjFeX7niuDX9K4Z1uh0WXMSYQYAK18VSqUyaPJjk02NAwZRiW1kkPZUC3nOIeby07N87hiyMMYvcwXX8aTYTmsEDsPtXWBndJfiq690hL3TRNktFFzI8dviNVTw5Ks34fgqaOMVdrWGF6r1nRnKOPJ8Dp389tX7u13xjHHv8CvzARzYwvmAutLIkZjdFh0raKNjVgnIIenbA1HcFK7","float":0.901}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'bn'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'hu'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Dr. Kareem Lakin'



## phone

A phone number in E164 format

Random value example: '+16800377789'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RfZnngBcQCHqrP2KaVD4Poe'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Cupiditate sit id est vel sed. Tempora sed aliquam illo nesciunt adipisci repellat nesciunt officia. Nihil id sit voluptates dolores reiciendis inventore.'



## time

Time (HH:MM:SS).

Random value example: '18:47:07'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2019-04-14T15:05:05+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Fortaleza'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 973884599



## url

Datatype for URLs

Random value example: 'http://www.von.com/voluptate-velit-nemo-delectus-qui-totam-placeat-exercitationem'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 35472



## uuid

Datatype for uuid values.

Random value example: 'ea1d7c67-3bb2-4619-8a01-a0edf4ffe2fb'



## year

Valid years. May create a special field in the database.

Random value example: 2001


