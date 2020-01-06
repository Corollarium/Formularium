<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

abstract class Datatype_choice extends \Formularium\Datatype
{
    /**
     * Valid choices. Override with a list of valid choices.
     *
     * @var array
     */
    protected $choices = [];

    public function __construct(string $typename = 'choice', string $basetype = 'choice')
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
            $choiceValues = [];
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

    public function validate($value, Field $field, Model $model = null)
    {
        if (!is_string($value) && !is_int($value)) {
            throw new ValidatorException('Invalid choice value ' . htmlspecialchars(print_r($value, true)));
        }
        if ($value === '' || array_key_exists($value, $this->choices)) {
            return $value;
        }
        throw new ValidatorException('Invalid choice value set: ' . htmlspecialchars((string)$value));
    }
}
