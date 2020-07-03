<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_countrycode;

class DatatypeLanguage_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\DatatypeFactory::factory('language');
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

    public function testChoice()
    {
        /**
         * @var Datatype_language $d
         */
        $d = $this->getDataType();
        $this->assertIsArray($d->getChoices());
        $random = $d->getRandom(['total' => 3]);
        $this->assertEquals(3, count($random));
    }
}
