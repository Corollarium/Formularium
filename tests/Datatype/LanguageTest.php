<?php declare(strict_types=1);

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;
use Formularium\Datatype\Datatype_countrycode;

class DatatypeLanguage_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('language');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => 'en',
                'expected' => 'en'
            ],
            [
                'value' => 'pt-br',
                'expected' => 'pt-br'
            ],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            [
                'value' => 'xmaj',
            ]
        ];
    }
}
