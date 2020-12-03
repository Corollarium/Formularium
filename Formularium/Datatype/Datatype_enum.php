<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

abstract class Datatype_enum extends \Formularium\Datatype
{
    /**
     * Valid choices. Override with a list of valid choices.
     *
     * @var array code => human name
     */
    protected $choices = [];

    public function __construct(string $typename, string $basetype = 'enum')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $total = $params['total'] ?? 1;
        if ($total == 1) {
            /**
             * @var string $index
             */
            $index = array_rand($this->choices, 1);
            return $index;
        } else {
            /**
             * @var array $rand_keys
             */
            $rand_keys = array_rand($this->choices, $total);
            return $rand_keys;
        }
    }

    public function getChoices(): array
    {
        return $this->choices;
    }

    public function validate($value, Model $model = null)
    {
        if (!is_string($value) && !is_int($value)) {
            throw new ValidatorException('Invalid enum value ' . htmlspecialchars(print_r($value, true)));
        }
        if ($value === '' || array_key_exists($value, $this->choices)) {
            return $value;
        }
        throw new ValidatorException('Invalid enum value set: ' . htmlspecialchars((string)$value));
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'VARCHAR(32)';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "string('$name', 32)";
    }

    public function getDocumentation(): string
    {
        return "Enums are a unique code -> string map fixed size map, stored in DB. Code is stored in the DB as a string.";
    }
}
