
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RHbGAwwoHvQUBSL'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RX0MUtuEKqLnuM'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RVO2ATeLe3x0n6'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '53.428.645/0001-96'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#A7CBA1'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'TW'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'SRB'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 674



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '675.211.358-06'



## currency

Currency names, with their 3-letter codes.

Random value example: 'SZL'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2022-03-08'



## datetime

Datetimes in ISO8601 format.

Random value example: '2022-09-29T08:29:04+0000'



## domain

Internet domain names.

Random value example: 'buckridge.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'dane50@schulist.com'



## file





## float

Floating point numbers.

Random value example: 0.872



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Voluptate et id officiis et laboriosam est omnis. Et rerum dignissimos minus non provident commodi numquam. Veritatis nobis voluptas velit odit impedit. Quos et ut incidunt totam sit ut.</span>Ratione sint qui impedit accusantium a. Libero veritatis facere ut quasi eaque eaque. Ut dolor natus sapiente optio repellendus officiis aspernatur. Et aspernatur qui et nam.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 398762051



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: 'd5:5b89:d681:2b6a:ae51:c4d6:da1e:eda'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '177.3.79.104'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '7a9a:2882:45a4:9545:3a75:b541:1cf5:6eb'



## json

Valid JSON data

Random value example: '{"version":114731278,"data":{"string":"RRYEizNOjubfS8UsqewYU5I6dVTDaUs9ilbeCviIcevVxvVlHNlqWzt5dfI30JDItrYEeSPr8ENXfA8lT","float":0.364}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'so'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'pl'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Shayna Smitham'



## phone

A phone number in E164 format

Random value example: '+15675270268'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RmtYggnaFK3LDh1nsKnp3LdEWuiMj8epbrAIKQhtbwTLEfJ1M82OonHN97vxCSRNd0J6MNdPyW358udKZrhMvN3WH9EH2YAdCLk92JOtbykEOpsnUgDZHF2bOzuh5Uds6IyMGIuSMQmW5rkz15qGe0PIczpQXYV'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Voluptatem soluta quasi in sed ipsum id omnis. Rerum architecto voluptatem dignissimos aut. Nostrum eos soluta et. Ad veniam et provident porro tenetur quis eos.'



## time

Time (HH:MM:SS).

Random value example: '14:38:24'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2017-10-03T12:06:33+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Pacific/Auckland'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 2047644605



## url

Datatype for URLs

Random value example: 'http://stiedemann.com/repellendus-accusamus-cum-cupiditate-occaecati-optio'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 46366



## uuid

Datatype for uuid values.

Random value example: '2e9aa3b1-438d-4f57-9114-03c7a5b1dd95'



## year

Valid years. May create a special field in the database.

Random value example: 2011


