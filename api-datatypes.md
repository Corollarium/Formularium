
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RXFiiYkyCrnEDM'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RLskrxePqdV3jd'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'Rj0joGFFauVyu'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '47.006.381/0001-80'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#66C0B7'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'PT'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'MWI'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 795



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '300.881.226-03'



## currency

Currency names, with their 3-letter codes.

Random value example: 'RWF'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2011-10-14'



## datetime

Datetimes in ISO8601 format.

Random value example: '2025-02-25T00:55:08+0000'



## domain

Internet domain names.

Random value example: 'heidenreich.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'horeilly@gmail.com'



## file





## float

Floating point numbers.

Random value example: 0.258



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Sequi dolore qui nesciunt. Accusamus voluptate quaerat possimus tempora. Quidem dolore nihil recusandae est et. Aspernatur occaecati temporibus voluptate nemo aspernatur iure cumque et.</span>Excepturi odit facilis eligendi aspernatur eos aut dolores. Autem maiores maiores eos non dolorum rerum non. Id repellat quo aut similique dolores aut. Quasi laboriosam officiis qui perspiciatis.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 77909253



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '7d37:46cd:d8f7:e361:93ce:ab9c:a681:d107'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '58.212.206.44'



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'c859:8d4e:6823:f8a6:eafc:800a:797d:57a'



## json

Valid JSON data

Random value example: '{"version":515043065,"data":{"string":"RaXIFxQuYtFgukUMyEDnJCaIJfiNeiD9pm94iHjqVky6BBKC592vBPVOhlcFB2cYyZap6XBbpPPdUglL3uS5rz3tB2t2xpUBIsobAqmpfuh2DhAvfWn7YSr4G5Yl08YTM7p9L3b63GJyQxso4XnTASFNJSNPhXZoKtvvGDvjv4SemAd6v4dw7jbW7aDjCGBFtoJtY1G6emloSU19RjSe","float":0.319}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'bg'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'co'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Nadia Legros'



## phone

A phone number in E164 format

Random value example: '+16313375734'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'R8rH3QfFumxRSQ82n6QtsF8GT1CMO2qfhkrRaGSs4jl9Wgl3hIq6IzsWcZgVulFTO1KmoNwHHdbHaCTLRwMNfKu2AmtP0TL9V8MBhM1AJe5SjP0QJ5QZ37mboMiHFaXmJ6BstlnGIKl506E1DnMM4AddZOfxo4ueFQr2WDhPzBb0GuFISZwXCP2yj2Ikxanh7pnG7lvgOwqiQcYsUI0GA4mKoXxL7IQcxx0'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Porro natus ut ducimus. Molestiae aut numquam quam rerum et dolores veritatis. Excepturi iste ut et sit facilis consequatur animi suscipit. Quia qui doloribus in voluptates aliquam repellendus.'



## time

Time (HH:MM:SS).

Random value example: '19:30:44'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2022-05-29T09:54:19+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Kamchatka'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 899478001



## url

Datatype for URLs

Random value example: 'http://www.nolan.net/'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 64337



## uuid

Datatype for uuid values.

Random value example: '80eda59d-d174-4320-bd84-d55101ff5925'



## year

Valid years. May create a special field in the database.

Random value example: 1993


