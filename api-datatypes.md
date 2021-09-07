
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RMWQHHzFIG'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RXE8H'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'R17bGe4EhPsGu'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '21.412.870/0001-48'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#B05175'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'MD'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'FLK'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 654



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '025.460.261-43'



## currency

Currency names, with their 3-letter codes.

Random value example: 'BSD'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2013-02-02'



## datetime

Datetimes in ISO8601 format.

Random value example: '2014-08-15T07:11:14+0000'



## domain

Internet domain names.

Random value example: 'hane.biz'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'tiara59@ondricka.biz'



## file





## float

Floating point numbers.

Random value example: 0.54



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Sed minus dicta facilis eligendi. Qui itaque et repellendus nihil rerum. Ab beatae odio sapiente beatae suscipit eius ut.</span>Nemo excepturi vitae animi delectus enim incidunt. Natus quidem minima harum culpa. Accusamus possimus quae dignissimos delectus voluptatem.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -2008086380



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '52.117.218.216'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '152.46.197.117'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '702:cda2:1d14:3c14:74e7:505c:e00a:4c2e'



## json

Valid JSON data

Random value example: '{"version":-66534708,"data":{"string":"RsWIPUqyfRswkiRXwcz1O3wNO7H5WCWW18y0hX9RIaToe1kwcmvLEi6CQLpTgWOeFygNfvFG31QSdnk2ZGrlMUTihGTkobCNcTwN3qGY5BKv7cTQGF1qEkTvuJ2lR90g","float":0.077}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'fo'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'ja'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Etha Dach'



## phone

A phone number in E164 format

Random value example: '+18505685430'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RUZXG9v00x57AHR7jcPViVdUxAqJ2IGfhoYqxeAWGlTHUDSvxRN20QZJoWRTRiNENT5DOTHHmPJPxwjwuRyisptp81l7MZ989zabReR0C07YK4QXFUvBcFb22k6BFZ22cORoLPNILWppdcaqS0rvlhY2tWsMuCHN'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Odio illo amet quo sit eos. Odio assumenda enim eos consequuntur quas maiores. Ratione iusto est ea sed. Soluta perspiciatis voluptatem sapiente natus aut tempora voluptatem quia.'



## time

Time (HH:MM:SS).

Random value example: '10:47:20'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2012-11-30T15:28:35+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Europe/Saratov'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 3842571226



## url

Datatype for URLs

Random value example: 'https://www.lockman.com/aut-natus-quasi-sed-ab-culpa'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 17466



## uuid

Datatype for uuid values.

Random value example: 'f3a1a42d-e24a-40bb-ab9a-9d2765143026'



## year

Valid years. May create a special field in the database.

Random value example: 1992


