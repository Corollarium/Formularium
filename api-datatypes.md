
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RGhvyVKPSQXu'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RencqVp'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'R-rjIhmAP0m'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '84.206.532/0001-70'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#D59C9E'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'VI'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'BOL'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 398



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '194.674.159-09'



## currency

Currency names, with their 3-letter codes.

Random value example: 'XPF'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2023-03-24'



## datetime

Datetimes in ISO8601 format.

Random value example: '2012-10-14T13:47:36+0000'



## domain

Internet domain names.

Random value example: 'gorczany.info'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'kskiles@yahoo.com'



## file





## float

Floating point numbers.

Random value example: 0.585



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Non et libero sunt doloribus vitae occaecati autem. Assumenda veniam ut dolor. Maiores quibusdam illo eum ea veritatis at et et. Numquam perferendis quam perferendis quas sint dolorem.</span>Asperiores porro molestias rem dignissimos provident nostrum nihil. Labore molestiae et in fugiat commodi.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -1674959494



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '5d58:dd0f:5aa0:3f30:299a:2a05:90c9:9fc3'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '21.39.174.32'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '4566:f9f0:bdaf:ecb1:8dc9:4de4:12b2:e89f'



## json

Valid JSON data

Random value example: '{"version":272606523,"data":{"string":"RPUVzuNP5DbXc1Aa4BdLB6FdeKnoT25SdlnhMiFHzdfgCYjq02JmRjDfTSUDEOc5sHyppRvpxfiChnUdmtglrea1kn6jP4jkjz0cCBnJUT5nXBNpNgWSmbc22ERFZrJC5Q5bMffOqeRrTCNUgnMZ5vUqoMg3lqRIKhXYvfVI1tAoewLMH93L1b4oNpybLwB5rY8mdGv7NX02RHLu1U6frCS0i0Kztdxg2viUN2J9n2","float":0.411}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'th'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'en'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Lauren DuBuque'



## phone

A phone number in E164 format

Random value example: '+13300162723'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RbXqOPengSw3QAn8CmanlFb9WuomfnNrCT90CEfOBMNBpDCAbBhhFXQrdPGn61wLNxgizMHGLvUbJFoWzNC4JqO3tIFjP0yhLiEQGyXXoaoJSUkd9ak1qvL6EzadexPg9J0DyVohShrtF62C'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Ducimus minima iure repudiandae reiciendis qui. Qui rerum tempora ipsa aperiam. Voluptatem qui quisquam ab omnis ut sint iure. Exercitationem expedita et sunt harum.'



## time

Time (HH:MM:SS).

Random value example: '01:26:10'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2020-05-29T21:07:06+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Muscat'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 2102421810



## url

Datatype for URLs

Random value example: 'http://www.schowalter.com/'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 49946



## uuid

Datatype for uuid values.

Random value example: 'e95e1dfe-ae18-40e8-ba0c-fdcae1ddcbc4'



## year

Valid years. May create a special field in the database.

Random value example: 1995


