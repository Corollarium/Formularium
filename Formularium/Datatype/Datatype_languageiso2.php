<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_languageiso2 extends Datatype_choice
{
    const LANGUAGES = [
        'aa' => 'Afaraf',
        'ab' => 'аҧсуа бызшәа, аҧсшәа',
        'ae' => 'Avesta',
        'af' => 'Afrikaans',
        'ak' => 'Akan',
        'am' => 'አማርኛ',
        'an' => 'aragonés',
        'ar' => 'العربية',
        'as' => 'অসমীয়া',
        'av' => 'авар мацӀ, магӀарул мацӀ',
        'ay' => 'Aymar aru',
        'az' => 'Azərbaycan dili',
        'ba' => 'башҡорт теле',
        'be' => 'беларуская мова',
        'bg' => 'български език',
        'bh' => 'भोजपुरी',
        'bi' => 'Bislama',
        'bm' => 'Bamanankan',
        'bn' => 'বাংলা',
        'bo' => 'བོད་ཡིག',
        'br' => 'Brezhoneg',
        'bs' => 'Bosanski jezik',
        'ca' => 'Català',
        'ce' => 'нохчийн мотт',
        'ch' => 'Chamoru',
        'co' => 'Corsu, lingua corsa',
        'cr' => 'ᓀᐦᐃᔭᐍᐏᐣ',
        'cs' => 'čeština, český jazyk',
        'cu' => 'ѩзыкъ словѣньскъ',
        'cv' => 'чӑваш чӗлхи',
        'cy' => 'Cymraeg',
        'da' => 'dansk',
        'de' => 'Deutsch',
        'dv' => 'ދިވެހި',
        'dz' => 'རྫོང་ཁ',
        'ee' => 'Eʋegbe',
        'el' => 'ελληνικά',
        'en' => 'English',
        'eo' => 'Esperanto',
        'es' => 'Español',
        'et' => 'Eesti, eesti keel',
        'eu' => 'Euskara, euskera',
        'fa' => 'فارسی',
        'ff' => 'Fulfulde, Pulaar, Pular',
        'fi' => 'Suomi, suomen kieli',
        'fj' => 'Vosa Vakaviti',
        'fo' => 'Føroyskt',
        'fr' => 'Français, langue française',
        'fy' => 'Frysk',
        'ga' => 'Gaeilge',
        'gd' => 'Gàidhlig',
        'gl' => 'Galego',
        'gn' => 'Avañe\'ẽ',
        'gu' => 'ગુજરાતી',
        'gv' => 'Gaelg, Gailck',
        'ha' => '(Hausa) هَوُسَ',
        'he' => 'עברית',
        'hi' => 'हिन्दी, हिंदी',
        'ho' => 'Hiri Motu',
        'hr' => 'hrvatski jezik',
        'ht' => 'Kreyòl ayisyen',
        'hu' => 'magyar',
        'hy' => 'Հայերեն',
        'hz' => 'Otjiherero',
        'ia' => 'Interlingua',
        'id' => 'Bahasa Indonesia',
        'ie' => 'Interlingue (Occidental)',
        'ig' => 'Asụsụ Igbo',
        'ii' => 'ꆈꌠ꒿ Nuosuhxop',
        'ik' => 'Iñupiaq, Iñupiatun',
        'io' => 'Ido',
        'is' => 'Íslenska',
        'it' => 'Italiano',
        'iu' => 'ᐃᓄᒃᑎᑐᑦ',
        'ja' => '日本語 (にほんご)',
        'jv' => 'ꦧꦱꦗꦮ, Basa Jawa',
        'ka' => 'ქართული',
        'kg' => 'Kikongo',
        'ki' => 'Gĩkũyũ',
        'kj' => 'Kuanyama',
        'kk' => 'қазақ тілі',
        'kl' => 'kalaallisut, kalaallit oqaasii',
        'km' => 'ខ្មែរ, ខេមរភាសា, ភាសាខ្មែរ',
        'kn' => 'ಕನ್ನಡ',
        'ko' => '한국어',
        'kr' => 'Kanuri',
        'ks' => 'कश्मीरी, كشميري‎',
        'ku' => 'Kurdî, كوردی‎',
        'kv' => 'коми кыв',
        'kw' => 'Kernewek',
        'ky' => 'Кыргызча, Кыргыз тили',
        'la' => 'latine, lingua latina',
        'lb' => 'Lëtzebuergesch',
        'lg' => 'Luganda',
        'li' => 'Limburgs',
        'ln' => 'Lingála',
        'lo' => 'ພາສາລາວ',
        'lt' => 'lietuvių kalba',
        'lu' => 'Tshiluba',
        'lv' => 'latviešu valoda',
        'mg' => 'fiteny malagasy',
        'mh' => 'Kajin M̧ajeļ',
        'mi' => 'te reo Māori',
        'mk' => 'македонски јазик',
        'ml' => 'മലയാളം',
        'mn' => 'Монгол хэл',
        'mr' => 'मराठी',
        'ms' => 'bahasa Melayu, بهاس ملايو‎',
        'mt' => 'Malti',
        'my' => 'ဗမာစာ',
        'na' => 'Dorerin Naoero',
        'nb' => 'Norsk bokmål',
        'nd' => 'isiNdebele',
        'ne' => 'नेपाली',
        'ng' => 'Owambo',
        'nl' => 'Nederlands, Vlaams',
        'nn' => 'Norsk nynorsk',
        'no' => 'Norsk',
        'nr' => 'isiNdebele',
        'nv' => 'Diné bizaad',
        'ny' => 'chiCheŵa, chinyanja',
        'oc' => 'occitan, lenga d\'òc',
        'oj' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
        'om' => 'Afaan Oromoo',
        'or' => 'ଓଡ଼ିଆ',
        'os' => 'ирон æвзаг',
        'pa' => 'ਪੰਜਾਬੀ',
        'pi' => 'पाऴि',
        'pl' => 'język polski, polszczyzna',
        'ps' => 'پښتو',
        'pt' => 'Português',
        'qu' => 'Runa Simi, Kichwa',
        'rm' => 'Rumantsch grischun',
        'rn' => 'Ikirundi',
        'ro' => 'Română',
        'ru' => 'Русский',
        'rw' => 'Ikinyarwanda',
        'sa' => 'संस्कृतम्',
        'sc' => 'Sardu',
        'sd' => 'सिन्धी, سنڌي، سندھی‎',
        'se' => 'Davvisámegiella',
        'sg' => 'yângâ tî sängö',
        'si' => 'සිංහල',
        'sk' => 'Slovenčina, slovenský jazyk',
        'sl' => 'Slovenski jezik, slovenščina',
        'sm' => 'gagana fa\'a Samoa',
        'sn' => 'chiShona',
        'so' => 'Soomaaliga, af Soomaali',
        'sq' => 'Shqip',
        'sr' => 'српски језик',
        'ss' => 'SiSwati',
        'st' => 'Sesotho',
        'su' => 'Basa Sunda',
        'sv' => 'Svenska',
        'sw' => 'Kiswahili',
        'ta' => 'தமிழ்',
        'te' => 'తెలుగు',
        'tg' => 'тоҷикӣ, toçikī, تاجیکی‎',
        'th' => 'ไทย',
        'ti' => 'ትግርኛ',
        'tk' => 'Türkmen, Түркмен',
        'tl' => 'Wikang Tagalog',
        'tn' => 'Setswana',
        'to' => 'faka Tonga',
        'tr' => 'Türkçe',
        'ts' => 'Xitsonga',
        'tt' => 'татар теле, tatar tele',
        'tw' => 'Twi',
        'ty' => 'Reo Tahiti',
        'ug' => 'ئۇيغۇرچە‎, Uyghurche',
        'uk' => 'Українська',
        'ur' => 'اردو',
        'uz' => 'Oʻzbek, Ўзбек, أۇزبېك‎',
        've' => 'Tshivenḓa',
        'vi' => 'Tiếng Việt',
        'vo' => 'Volapük',
        'wa' => 'walon',
        'wo' => 'Wollof',
        'xh' => 'isiXhosa',
        'yi' => 'ייִדיש',
        'yo' => 'Yorùbá',
        'za' => 'Saɯ cueŋƅ, Saw cuengh',
        'zh' => '中文 (Zhōngwén), 汉语, 漢語',
        'zu' => 'isiZulu',
    ];

    public function __construct(string $typename = 'languageiso2', string $basetype = 'choice')
    {
        parent::__construct($typename, $basetype);
        $this->choices = self::LANGUAGES;
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'CHAR(2)';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "char('$name', 2)";
    }

    public function getDocumentation(): string
    {
        return 'Languages represented by ISO630-1 2-letter codes.';
    }
}