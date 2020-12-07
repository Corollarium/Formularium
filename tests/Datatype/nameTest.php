<?php declare(strict_types=1);

namespace Tests\Unit;

use Formularium\Datatype;
use Formularium\Factory\DatatypeFactory;
use FormulariumTests\Datatype\DatatypeBaseTestCase;

class nameTest extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): Datatype
    {
        return DatatypeFactory::factory('name');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => 'John Doe', // TODO
                'expected' => 'John Doe' // TODO
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
            null
        ];
    }
}
