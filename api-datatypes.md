
# Datatypes

List of validators and its parameters generated automatically.

## alpha

String with only alphabetical ASCII letters.

Random value example: 'RjhXpVhE'



## alphanum

String with only alphabetical ASCII letters and numbers.

Random value example: 'RScgA7IBiPaq'



## alphanumdash

String with only alphabetical ASCII letters, numbers, underscore _ and dash -.

Random value example: 'RGn8QdUwGN2ek'



## bool

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: true



## boolean

Datatype for boolean values. Accepts actual boolean values, "true"/"false" strings and 0/1 numbers.

Random value example: false



## cnpj

Datatype for Brazilian CNPJ document numbers.

Random value example: '40.385.291/0001-06'



## color

Datatype for RGB colors in hexadecimeal format, starting with #.

Random value example: '#1F095A'



## constant

Constant values



## countrycodeiso2

Country names represented by ISO 2-letter codes.

Random value example: 'YE'



## countrycodeiso3

Country names represented by ISO 3-letter codes.

Random value example: 'NIC'



## countrycodenumeric

Country names represented by ISO numeric codes.

Random value example: 624



## cpf

Datatype for Brazilian CPF document numbers.

Random value example: '533.684.790-91'



## currency

Currency names, with their 3-letter codes.

Random value example: 'TTD'



## date

Dates in ISO format: YYYY-MM-DD.

Random value example: '2029-11-21'



## datetime

Datetimes in ISO8601 format.

Random value example: '2023-02-26T18:31:13+0000'



## domain

Internet domain names.

Random value example: 'rath.org'



## email

Emails (hopefully, but we use Respect for validation)

Random value example: 'bsteuber@hotmail.com'



## file





## float

Floating point numbers.

Random value example: 0.974



## html

HTML, validated and sanitized with HTMLPurifier.

Random value example: '<p>HTML <span>Pariatur corporis occaecati qui aut quo. Non quis dolorem vero libero.</span>Quia doloremque fuga qui occaecati. Aut ut nulla omnis rerum molestias molestiae. Neque aut ab distinctio.</p>'



## integer

Datatype for integers, between -2147483648 and 2147483647.

Random value example: -381693874



## ip

Strings in UTF-8 and sanitized, up to 39 characters (which might be more than its bytes).

Random value example: 'ff11:6df6:2de0:6cc1:78a6:3bb3:fbd0:2960'



## ipv4

Datatype for IPs in IPV4 format

Random value example: '252.191.130.119'



## ipv6

Datatype for IPs in IPV6 format

Random value example: 'a905:826f:f0e:c7bf:b0dd:e693:cb0d:efc8'



## json

Valid JSON data

Random value example: '{"version":-1021450929,"data":{"string":"RmtoR8hfWaJeH1zmUOES2E8FzRw2neyaMxMEEhIODG9Lyvonr84ZcIcvkt5DfmdSEJ1mJq0YvdXCLh2jItBv1grIuZgAD4aNzILoc52QlAuF2mMFPsV4IHYGsXqMzCVZW1INxRs7bOrpvYKG28QrkkqEaq3RLIWDy0EPz0Va2ohKL0mU0SJEs5ybjfOwyPbqUmGDbfBm4FIy3ZpJb5SVYyX6ZoeHr0uvKlElgwx0S5dz54NkvVyCcaEXa4","float":0.541}}'



## language

Languages. Names are in the actual language. This follows wikipedia, prefer 'languageiso2' for an ISO standard.

Random value example: 'to'



## languageiso2

Languages represented by ISO630-1 2-letter codes.

Random value example: 'lv'



## name

Just a plain string, but that expects a name. Generates good random names.

Random value example: 'Dr. Vivienne Fadel'



## phone

A phone number in E164 format

Random value example: '+14583748641'



## string

Strings in UTF-8 and sanitized, up to 256 characters (which might be more than its bytes).

Random value example: 'Rfsp3TnylVV4DDA7pioOrJhgYMIN5yOJFFU07AvA4KP14SHM3t69ZJCsRYHjTGo55CvHokq98ptKAR7JXndKoekPMFhPqlgs5f3C0es8vLUbDKb3NAWiM4xKJQOiJTQdab6AdXUlbAWHQySRxb1f84C8Es8RR6EGEP13t0910nTi4gyqNfPpUUbDpHFFg8lgmaCz5wKodtz4gNwz02D71j8XANozBxIg8pq0yr1bh1MeiPSTukY6ks'



## text

Long text in UTF-8 and sanitized, up to 1024000 characters (which might be more than its bytes).

Random value example: 'Et a placeat temporibus inventore aut officiis. Placeat non officiis est illum sed sed quo. Perferendis sunt consequuntur quidem quia. Harum et qui enim ab unde nulla.'



## time

Time (HH:MM:SS).

Random value example: '11:31:10'



## timestamp

Timestamps. Just like datetime, but might be a different type in your database.

Random value example: '2017-07-16T19:19:45+0000'



## timezone

Timezones. Follows PHP timezone_identifiers_list().

Random value example: 'Pacific/Pago_Pago'



## uinteger

Datatype for unsigned integers, between 0 and 4294967296.

Random value example: 3071174454



## url

Datatype for URLs

Random value example: 'http://marvin.com/nulla-aspernatur-eum-sed-ad-asperiores-voluptas-exercitationem.html'



## usmall

Datatype for unsigned small integers, between 0 and 65536.

Random value example: 5873



## uuid

Datatype for uuid values.

Random value example: 'c9c2edae-371c-4a94-a58e-0e121bdea8b6'



## year

Valid years. May create a special field in the database.

Random value example: 1998


