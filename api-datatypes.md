
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RabOzXfLr'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RirREgnztECoF'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RubmrxE1OFjYmPv'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '50.217.140/0001-94'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#8FBA23'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'FO'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'AUT'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: '051'



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '089.447.133-32'



## currency

Currency names, with their 3-letter codes.

Random value example: 'KZT'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2026-07-15'



## datetime

Datetimes in ISO8601 format.

Random value example: '2026-07-26T17:26:19+0000'



## domain

Internet domain names.

Random value example: 'abbott.com'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'abe.zieme@bergstrom.com'



## file





## float

Floating point numbers.

Random value example: 0.367



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Explicabo magnam quia et sunt repudiandae et. In temporibus tenetur quia est voluptas qui pariatur. Earum sunt quia cumque velit. Iusto eos ut odit natus.</span>Impedit provident accusamus est ullam rerum illo. Voluptas aut dolor nihil corporis. Dolorum ipsa inventore harum impedit alias eligendi.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: 897834271



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: '67.248.173.208'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '58.192.66.104'



## ipv6

Datatype for IPs in IPV6 format

Random value example: '551a:66d8:55e4:657a:d40e:3bbe:5aa5:324d'



## json

Valid JSON data

Random value example: '{"version":1433363355,"data":{"string":"RMtBAfRVc5bODNbdkMSdIjXYXXmPV6KcK5YcJ3uehE0J7CsoJ8lWSKSjtVMji9TXgim6i2lwPLdqoKop2mdeqdvbuORP3zBwnmoXXwl05Uyv4wyrLchGY9c9Gr4k8YKa","float":0.472}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'ty'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'sm'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Marcellus Kuhn'



## phone

A phone number in E164 format

Random value example: '+14808781476'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'RDyC2LjRl0kva3OHnobJ0jYIuylm642x5IxfNpcsfY1qAHw9QAkZ9ypxY8i6O3TwBiMwyZUt1475R0YEGcd1F3686JtZT3pR20z2McaCaw4eqnziyzYLXIeRlYSWYg'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Reprehenderit illum ea totam voluptatem. Delectus consequatur et quisquam eum suscipit reprehenderit nam. Quam qui quibusdam adipisci impedit quaerat sit ut.'



## time

Time (HH:MM:SS).

Random value example: '21:18:18'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2015-07-17T05:45:38+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Asia/Yekaterinburg'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 2486276189



## url

Datatype for URLs

Random value example: 'http://www.breitenberg.info/cupiditate-dolor-amet-minus-consectetur'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 19548



## uuid

Datatype for uuid values.

Random value example: '4726839b-0c61-4452-8ed2-631f0cb4397c'



## year

Valid years. May create a special field in the database.

Random value example: 2015


