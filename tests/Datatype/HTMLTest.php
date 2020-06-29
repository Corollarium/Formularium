<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class DatatypeHTML_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('html');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            "<p>Test</p>",
            [
                'value' => '</p>',
                'expected' => '',
            ],
            [
                'value' => '<p>asasdf',
                'expected' => '<p>asasdf</p>',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        $dt = $this->getDataType();
        return [
            null
        ];
    }
}
