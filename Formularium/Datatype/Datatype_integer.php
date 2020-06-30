<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
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
        $min = $params[static::MIN]['value'] ?? $this->minvalue;
        $max = $params[static::MAX]['value'] ?? $this->maxvalue;
        return mt_rand($min, $max);
    }

    public function validate($value, Model $model = null)
    {
        if ($value === '') {
            return $value;
        } elseif (!V::intVal()->between($this->minvalue, $this->maxvalue, true)->validate($value)) {
            throw new ValidatorException("Invalid integer value, must be between {$this->minvalue} and {$this->maxvalue}");
        }

        return $value;
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'INT';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return 'integer';
    }
}
