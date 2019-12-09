<?php

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class DatatypeDate_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('date');
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
            '0000-00-00',
            ''
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
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
