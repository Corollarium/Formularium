<?php

declare(strict_types=1);

use \Formularium\Field;

abstract class DatatypeBaseTestCase extends PHPUnit\Framework\TestCase
{

    /**
     * Must return the datatype class instance.
     *
     * @return \Formularium\Datatype
     */
    abstract public function getDataType(): \Formularium\Datatype;

    /**
     * List of valid values.
     *
     * required: $v['value']
     * optional: $v['expected']
     * optional: $v['validators']
     *
     * @return array
     */
    abstract public function getValidValues();

    /**
     * List of invalid values.
     *
     * required: $v['value']
     * optional: $v['expected']
     * optional: $v['validators']
     *
     * @return array
     */
    abstract public function getInvalidValues();

    public function testValidate()
    {
        foreach ($this->getValidValues() as $v) {
            if (!is_array($v)) {
                $value = $v;
                $expected = $v;
                $validators = [];
            } else {
                $value = $v['value'];
                $expected = $v['expected'] ?? $v['value'];
                $validators = $v['validators'] ?? [];
            }
            $datatype = $this->getDataType();
            $validated = '';
            try {
                $f = new Field($datatype->getName(), $datatype, [], $validators);
                $validated = $datatype->validate($value, $f);
            } catch (Exception $e) {
                $this->assertFalse(true, $e->getMessage() . '. Value: ' . print_r($value, true));
                return;
            }
            $this->assertEquals($expected, $validated);
        }
    }

    public function testInvalidate()
    {
        foreach ($this->getInvalidValues() as $v) {
            if (!is_array($v)) {
                $value = $v;
                $validators = [];
            } else {
                $value = $v['value'];
                $validators = $v['validators'] ?? [];
            }
            try {
                $datatype = $this->getDataType();
                $f = new Field($datatype->getName(), $datatype, [], $validators);
                $datatype->validate($value, $f);
                $this->assertFalse(true, "Test invalidate passed");
            } catch (Exception $e) {
                $this->assertTrue(true, $e->getMessage() . ' Data: ' . print_r($value, true));
            }
        }
    }

    public function testRandom()
    {
        for ($i = 0; $i < 5; $i++) {
            $datatype = $this->getDataType();
            $value = $datatype->getRandom();
            $f = new Field($datatype->getName(), $datatype);
            $this->assertEquals($value, $datatype->validate($value, $f), 'Data: ' . print_r($value, true));
        }
    }

    public function testDefault()
    {
        $datatype = $this->getDataType();
        $value = $datatype->getDefault();
        $f = new Field($datatype->getName(), $datatype);
        $this->assertEquals($value, $datatype->validate($value, $f), 'Data: ' . print_r($value, true));
    }
}
