<?php declare(strict_types=1);

namespace FormulariumTests\Datatype;

use Formularium\Datatype;

class DatatypeAlpha_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('alpha');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => 'asdfkopasdfjopajsopdf',
                'expected' => 'asdfkopasdfjopajsopdf'
                // optional: 'validators' => []
            ]
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            [
                'value' => 'fsd asdf asdf',
            ],
            [
                'value' => 'fsd2323asdf',
            ]
        ];
    }
}
