<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_countrycode;

class Languageiso2Test extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Factory\DatatypeFactory::factory('languageiso2');
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
                'value' => 'pt',
                'expected' => 'pt'
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
