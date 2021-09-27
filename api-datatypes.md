
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RVodu'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RBkeeiA'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RNryAgvIyes3'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '75.775.874/0001-10'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#B65EBC'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'CX'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'BVT'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 659



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '551.410.998-49'



## currency

Currency names, with their 3-letter codes.

Random value example: 'ZMW'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2017-08-23'



## datetime

Datetimes in ISO8601 format.

Random value example: '2017-05-24T19:20:23+0000'



## domain

Internet domain names.

Random value example: 'prohaska.biz'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'mante.lexie@gmail.com'



## file





## float

Floating point numbers.

Random value example: 0.709



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Quam sit perspiciatis repellendus veritatis fugiat. Animi natus officiis quidem veritatis est et rem. Cumque aliquam eius sed quos. Omnis amet nihil voluptate aut ut laudantium.</span>Voluptates unde laudantium est nostrum. Architecto ea id minima repudiandae quo ut. Quas veniam voluptatibus accusamus saepe ea quos.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -763838365



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '1698:d0f5:624d:eeb9:7bb1:b337:d955:4f72'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '50.125.216.231'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '20a7:9bf2:de0c:4be3:3d1:4ff9:be41:371f'



## json

Valid JSON data

Random value example: '{"version":1056432955,"data":{"string":"RHtCn5E59ImVOJym5FUg04s5SPVXCnN8HrubV6dHzvsiZ3JQxYwmFeGzmi4vr9F8PV","float":0.44}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'eu'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'fi'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Ashton Huel'



## phone

A phone number in E164 format

Random value example: '+17312611235'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RaYs2CzZdqFt4zMxqWTeYnQqtI567e0v1W6raMw8LXqyMX2RK9GxV9FRORU6oaWSWYR05GnitQ82AtAiBu8xj1meSyXsCB6gRww1Cw6maVncGeQzucUa8Rin5C8nTlWWq5STAwhGAwSba46vOjvp1a1k2UhOIfv8AlHFhvLGUOp94Ba1hUQin6PsXA6KBJ9yT3neiICe7sbrxxfhgR09jxQPDu'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Rem eius placeat asperiores iusto omnis dicta. Iste repellat tenetur nihil maxime ut quasi. Voluptas quis vero quasi saepe sit accusantium. Porro et autem minus deleniti vel ad.'



## time

Time (HH:MM:SS).

Random value example: '22:44:04'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2020-03-02T09:07:29+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Tbilisi'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 1973477799



## url

Datatype for URLs

Random value example: 'http://www.crooks.org/maxime-aut-beatae-doloribus-molestias-tempore-sapiente-nostrum'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 65212



## uuid

Datatype for uuid values.

Random value example: 'a959260e-7244-4d0a-bbab-e736b46b4b51'



## year

Valid years. May create a special field in the database.

Random value example: 1996


