<?php declare(strict_types=1);

require_once('DatatypeBaseTestCase.php');

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
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        $dt = $this->getDataType();
        return [
            '</p>',
            '<p>asasdf',
            null
        ];
    }
}
