<?php

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Respect\Validation\Validator as V;

class Datatype_integer extends \Formularium\Datatype\Datatype_number
{
    /**
     * min acceptable value
     *
     * @var integer
     */
    protected $minvalue = -2147483648;

    /**
     * Max acceptable value
     *
     * @var integer
     */
    protected $maxvalue = 2147483647;
    
    public function __construct(string $typename = 'integer', string $basetype = 'number')
    {
        parent::__construct($typename, $basetype);
    }

    public function getMinValue(): int
    {
        return $this->minvalue;
    }

    public function getMaxValue(): int
    {
        return $this->maxvalue;
    }
    
    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN] ?? $this->minvalue;
        $max = $params[static::MAX] ?? $this->maxvalue;
        return mt_rand($min, $max);
    }

    public function validate($value, Field $f)
    {
        if ($value == '') {
            return $value;
        } elseif (!V::intVal()->between($this->minvalue, $this->maxvalue, true)->validate($value)) {
            throw new ValidatorException('Invalid integer value');
        }

        return $value;
    }
}
