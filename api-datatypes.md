
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RNvetkgora'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RoLmdwG3o'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'R-YxsL'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '17.417.202/0001-36'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#9A512F'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'CU'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'HVO'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 876



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '782.669.468-09'



## currency

Currency names, with their 3-letter codes.

Random value example: 'XDR'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2019-02-20'



## datetime

Datetimes in ISO8601 format.

Random value example: '2012-06-09T23:06:26+0000'



## domain

Internet domain names.

Random value example: 'dare.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'eulah13@donnelly.com'



## file





## float

Floating point numbers.

Random value example: 0.945



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Libero blanditiis et molestiae deserunt nam. Modi dolor blanditiis deserunt voluptatem inventore temporibus blanditiis repellat. Distinctio quia sit hic ad ut quidem dolor. Quos autem dolor ut.</span>Dignissimos assumenda ut eius deserunt. Rem earum enim cupiditate corrupti. Laboriosam omnis vel est aut occaecati tempora earum quas. Quibusdam eum quis maxime sint.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 764875638



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '93.80.3.76'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '154.225.50.156'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '77d7:5e1b:148a:e03f:85f5:ec15:5df9:1bdd'



## json

Valid JSON data

Random value example: '{"version":-1345834097,"data":{"string":"Rvv5o6dF2YBFGHmu5AFD3v41Jzqd5KRlNgwKLIpeuUrwDllYsOcwsD38eoNIpnXdiWPYaUXtxwJ5BGfs6xR4jNH4vjcBTC1PqtSweIKSSetdxcFyMcWTvj4CQBdAeASstVVE9EL","float":0.662}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'pt'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'ta'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Alessia Reilly'



## phone

A phone number in E164 format

Random value example: '+15201524268'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RxSQKzxPlEG3LNGTNXo5hnRXwPrnOQteunvc8eEZbYzuTM6m8rIWZBp9GcflHddrWMGWRZK6WL52xbJ8Cry6P'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Autem voluptatem aut quia ipsum quidem expedita et. Rerum iure recusandae ut corporis officia illum. Animi saepe debitis velit optio.'



## time

Time (HH:MM:SS).

Random value example: '23:15:54'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2019-05-25T22:33:56+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'America/Managua'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 887845040



## url

Datatype for URLs

Random value example: 'http://www.hegmann.biz/'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 33054



## uuid

Datatype for uuid values.

Random value example: 'ed753fe8-e19c-4d43-ae30-684b8b527a36'



## year

Valid years. May create a special field in the database.

Random value example: 2012


