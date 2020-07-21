<?php

declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Exception\ValidatorException;

class Datatype_currency extends \Formularium\Datatype\Datatype_choice
{
    public function __construct(string $typename = 'currency', string $basetype = 'choice')
    {
        parent::__construct($typename, $basetype);
        $this->choices = [
            'XUA' => 'ADB Unit of Account',
            'AFN' => 'Afghani',
            'DZD' => 'Algerian Dinar',
            'ARS' => 'Argentine Peso',
            'AMD' => 'Armenian Dram',
            'AWG' => 'Aruban Florin',
            'AUD' => 'Australian Dollar',
            'AZN' => 'Azerbaijan Manat',
            'BSD' => 'Bahamian Dollar',
            'BHD' => 'Bahraini Dinar',
            'THB' => 'Baht',
            'PAB' => 'Balboa',
            'BBD' => 'Barbados Dollar',
            'BYN' => 'Belarusian Ruble',
            'BZD' => 'Belize Dollar',
            'BMD' => 'Bermudian Dollar',
            'BOB' => 'Boliviano',
            'VES' => 'Bolívar Soberano',
            'XBA' => 'Bond Markets Unit European Composite Unit (EURCO)',
            'XBB' => 'Bond Markets Unit European Monetary Unit (E.M.U.-6)',
            'XBD' => 'Bond Markets Unit European Unit of Account 17 (E.U.A.-17)',
            'XBC' => 'Bond Markets Unit European Unit of Account 9 (E.U.A.-9)',
            'BRL' => 'Brazilian Real',
            'BND' => 'Brunei Dollar',
            'BGN' => 'Bulgarian Lev',
            'BIF' => 'Burundi Franc',
            'XOF' => 'CFA Franc BCEAO',
            'XAF' => 'CFA Franc BEAC',
            'XPF' => 'CFP Franc',
            'CVE' => 'Cabo Verde Escudo',
            'CAD' => 'Canadian Dollar',
            'KYD' => 'Cayman Islands Dollar',
            'CLP' => 'Chilean Peso',
            'XTS' => 'Codes specifically reserved for testing purposes',
            'COP' => 'Colombian Peso',
            'KMF' => 'Comorian Franc',
            'CDF' => 'Congolese Franc',
            'BAM' => 'Convertible Mark',
            'NIO' => 'Cordoba Oro',
            'CRC' => 'Costa Rican Colon',
            'CUP' => 'Cuban Peso',
            'CZK' => 'Czech Koruna',
            'GMD' => 'Dalasi',
            'DKK' => 'Danish Krone',
            'MKD' => 'Denar',
            'DJF' => 'Djibouti Franc',
            'STN' => 'Dobra',
            'DOP' => 'Dominican Peso',
            'VND' => 'Dong',
            'XCD' => 'East Caribbean Dollar',
            'EGP' => 'Egyptian Pound',
            'SVC' => 'El Salvador Colon',
            'ETB' => 'Ethiopian Birr',
            'EUR' => 'Euro',
            'FKP' => 'Falkland Islands Pound',
            'FJD' => 'Fiji Dollar',
            'HUF' => 'Forint',
            'GHS' => 'Ghana Cedi',
            'GIP' => 'Gibraltar Pound',
            'XAU' => 'Gold',
            'HTG' => 'Gourde',
            'PYG' => 'Guarani',
            'GNF' => 'Guinean Franc',
            'GYD' => 'Guyana Dollar',
            'HKD' => 'Hong Kong Dollar',
            'UAH' => 'Hryvnia',
            'ISK' => 'Iceland Krona',
            'INR' => 'Indian Rupee',
            'IRR' => 'Iranian Rial',
            'IQD' => 'Iraqi Dinar',
            'JMD' => 'Jamaican Dollar',
            'JOD' => 'Jordanian Dinar',
            'KES' => 'Kenyan Shilling',
            'PGK' => 'Kina',
            'HRK' => 'Kuna',
            'KWD' => 'Kuwaiti Dinar',
            'AOA' => 'Kwanza',
            'MMK' => 'Kyat',
            'LAK' => 'Lao Kip',
            'GEL' => 'Lari',
            'LBP' => 'Lebanese Pound',
            'ALL' => 'Lek',
            'HNL' => 'Lempira',
            'SLL' => 'Leone',
            'LRD' => 'Liberian Dollar',
            'LYD' => 'Libyan Dinar',
            'SZL' => 'Lilangeni',
            'LSL' => 'Loti',
            'MGA' => 'Malagasy Ariary',
            'MWK' => 'Malawi Kwacha',
            'MYR' => 'Malaysian Ringgit',
            'MUR' => 'Mauritius Rupee',
            'MXN' => 'Mexican Peso',
            'MXV' => 'Mexican Unidad de Inversion (UDI)',
            'MDL' => 'Moldovan Leu',
            'MAD' => 'Moroccan Dirham',
            'MZN' => 'Mozambique Metical',
            'BOV' => 'Mvdol',
            'NGN' => 'Naira',
            'ERN' => 'Nakfa',
            'NAD' => 'Namibia Dollar',
            'NPR' => 'Nepalese Rupee',
            'ANG' => 'Netherlands Antillean Guilder',
            'ILS' => 'New Israeli Sheqel',
            'TWD' => 'New Taiwan Dollar',
            'NZD' => 'New Zealand Dollar',
            'BTN' => 'Ngultrum',
            'KPW' => 'North Korean Won',
            'NOK' => 'Norwegian Krone',
            'MRU' => 'Ouguiya',
            'PKR' => 'Pakistan Rupee',
            'XPD' => 'Palladium',
            'MOP' => 'Pataca',
            'TOP' => 'Pa’anga',
            'CUC' => 'Peso Convertible',
            'UYU' => 'Peso Uruguayo',
            'PHP' => 'Philippine Peso',
            'XPT' => 'Platinum',
            'GBP' => 'Pound Sterling',
            'BWP' => 'Pula',
            'QAR' => 'Qatari Rial',
            'GTQ' => 'Quetzal',
            'ZAR' => 'Rand',
            'OMR' => 'Rial Omani',
            'KHR' => 'Riel',
            'RON' => 'Romanian Leu',
            'MVR' => 'Rufiyaa',
            'IDR' => 'Rupiah',
            'RUB' => 'Russian Ruble',
            'RWF' => 'Rwanda Franc',
            'XDR' => 'SDR (Special Drawing Right)',
            'SHP' => 'Saint Helena Pound',
            'SAR' => 'Saudi Riyal',
            'RSD' => 'Serbian Dinar',
            'SCR' => 'Seychelles Rupee',
            'XAG' => 'Silver',
            'SGD' => 'Singapore Dollar',
            'PEN' => 'Sol',
            'SBD' => 'Solomon Islands Dollar',
            'KGS' => 'Som',
            'SOS' => 'Somali Shilling',
            'TJS' => 'Somoni',
            'SSP' => 'South Sudanese Pound',
            'LKR' => 'Sri Lanka Rupee',
            'XSU' => 'Sucre',
            'SDG' => 'Sudanese Pound',
            'SRD' => 'Surinam Dollar',
            'SEK' => 'Swedish Krona',
            'CHF' => 'Swiss Franc',
            'SYP' => 'Syrian Pound',
            'BDT' => 'Taka',
            'WST' => 'Tala',
            'TZS' => 'Tanzanian Shilling',
            'KZT' => 'Tenge',
            'XXX' => 'The codes assigned for transactions where no currency is involved',
            'TTD' => 'Trinidad and Tobago Dollar',
            'MNT' => 'Tugrik',
            'TND' => 'Tunisian Dinar',
            'TRY' => 'Turkish Lira',
            'TMT' => 'Turkmenistan New Manat',
            'AED' => 'UAE Dirham',
            'USD' => 'US Dollar',
            'USN' => 'US Dollar (Next day)',
            'UGX' => 'Uganda Shilling',
            'UYW' => 'Unidad Previsional',
            'CLF' => 'Unidad de Fomento',
            'COU' => 'Unidad de Valor Real',
            'UYI' => 'Uruguay Peso en Unidades Indexadas (UI)',
            'UZS' => 'Uzbekistan Sum',
            'VUV' => 'Vatu',
            'CHE' => 'WIR Euro',
            'CHW' => 'WIR Franc',
            'KRW' => 'Won',
            'YER' => 'Yemeni Rial',
            'JPY' => 'Yen',
            'CNY' => 'Yuan Renminbi',
            'ZMW' => 'Zambian Kwacha',
            'ZWL' => 'Zimbabwe Dollar',
            'PLN' => 'Zloty',
        ];
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'CHAR(3)';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "char($name, 3)";
    }
}