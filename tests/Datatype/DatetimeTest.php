<?php declare(strict_types=1); 

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class DatatypeDatetime_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('datetime');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            '',
            [
                'value' => '2014-01-01T15:22:00Z',
                'expected' => '2014-01-01T15:22:00+0000',
            ],
            [
                'value' => '2014-01-01T15:22:00+03:00',
                'expected' => '2014-01-01T15:22:00+0300',
            ],
            [
                'value' => '2014-01-01T15:22:00+0300',
                'expected' => '2014-01-01T15:22:00+0300',
            ]
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            'a',
            '2014-01-01 15:22:00',
            '-0001-01-01',
            '35000-01-02',
            '2001-13-01',
            '0001-12--1',
            'notadate',
            '003-041-11',
            '01-01-2000',
            '2001/01/01abacaxi',
            '2012-25-01',
            '2001-02-31',
            '0000-01-01',
            'nota-da-te',
            '02015-01-01',
            '2000-1-29',
            1234567,
            ' ',
            '-0000-01-01',
            '1990-01-14',
            '1000.01.01',
            '2001-00-00'
        ];
    }
}
