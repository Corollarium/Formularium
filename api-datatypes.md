
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RFHkKtNnI'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RybR9Nq'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RGmuRZ9sgY6uUK'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '74.073.764/0001-43'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#D13068'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'NO'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'TLS'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 104



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '044.501.657-48'



## currency

Currency names, with their 3-letter codes.

Random value example: 'BDT'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2025-06-10'



## datetime

Datetimes in ISO8601 format.

Random value example: '2030-04-24T17:28:50+0000'



## domain

Internet domain names.

Random value example: 'schaden.info'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'logan26@zulauf.org'



## file





## float

Floating point numbers.

Random value example: 0.69



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Quasi voluptas omnis nihil omnis sunt quia dolores. Dicta non aspernatur aut. Nemo repellat aliquid perferendis deleniti.</span>Voluptatibus sequi enim numquam soluta maxime. Delectus neque sed porro alias sint ad quis. Quia ducimus repellendus sed et nihil architecto aut. Sint quos unde ipsum deserunt.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 88248676



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '29.215.56.208'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '191.91.55.89'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '7400:e739:2b25:5cf9:92aa:f5fc:3f70:868b'



## json

Valid JSON data

Random value example: '{"version":-634797885,"data":{"string":"Rk06gK8563HxWGToJO4fCnhcyjuLgq3","float":0.115}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'ki'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'kr'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Ms. Matilde Goldner V'



## phone

A phone number in E164 format

Random value example: '+16409402428'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RThfk9c4YWuQZ78VDdrTxxXmix8oMpizX1cCtu9mq62YMOOdzgsQWqBTcJMw9HBFBitEpQk4X2wCMKPc7evfbNPuZyfyRsJLhRnfU6Y1fuCFxQWev0BNLnGCA6tSrXlh5qKd3iam22DjcBaJmADyf3pCRuzuiuiv5z3R0uUTQs1CQWRFAU7MapmwPK4plOLmNxjDNs2nCbQ1sZ9Dwv4onqqHKKaFGbeTlj'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Sint earum quia velit libero quos qui. Reiciendis quo dolores eligendi et deserunt molestias. Occaecati earum consequatur est nostrum. Enim ullam perferendis accusantium fugit perferendis.'



## time

Time (HH:MM:SS).

Random value example: '20:16:09'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2017-08-07T02:01:43+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Antarctica/Palmer'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 3029362169



## url

Datatype for URLs

Random value example: 'http://jenkins.com/at-tempore-aut-nesciunt-soluta-commodi-similique'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 27524



## uuid

Datatype for uuid values.

Random value example: 'b2f77b2f-be71-4fdd-a982-d6a61e30861b'



## year

Valid years. May create a special field in the database.

Random value example: 2020


