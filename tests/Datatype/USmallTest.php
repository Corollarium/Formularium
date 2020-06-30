<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_integer;

class DatatypeUSmall_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('usmall');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        /**
         * @var Datatype_integer $dt
         */
        $dt = $this->getDataType();
        return [3, 2340, '2340', 40304, 0, $dt->getMinValue(), $dt->getMaxValue(), ''];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        /**
         * @var Datatype_integer $dt
         */
        $dt = $this->getDataType();
        return [
            'a',
            'bisfowsero',
            323.32,
            null,
            -3234,
            593495,
            994234023042934923492349,
            $dt->getMinValue()-1,
            $dt->getMaxValue()+1
        ];
    }
}
