<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class DateTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Factory\DatatypeFactory::factory('date');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            '2014-01-01',
            '2011-05-07',
            '0001-01-01',
            ''
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            '0000-00-00',
            '-0001-21-01',
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
            1234567,
            ' ',
            '-0000-01-01',
            '1000.01.01',
            '2001-00-00'
        ];
    }
}
