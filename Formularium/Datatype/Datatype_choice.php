<?php

namespace Formularium\Datatype;

use Formularium\Field;
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
            return $this->choices[$index];
        } else {
            $choiceValues = [];
            /**
             * @var array $rand_keys
             */
            $rand_keys = array_rand($this->choices, $total);
            foreach ($rand_keys as $r) {
                $choiceValues[] = $this->choices[$r];
            }
            return $choiceValues;
        }
    }

    public function getChoices(): array
    {
        return $this->choices;
    }

    public function validate($value, Field $f)
    {
        if (!is_string($value) && !is_int($value)) {
            throw new ValidatorException('Invalid choice value ' . htmlspecialchars(print_r($value, true)));
        }
        if ($value === '' || in_array($value, $this->choices)) {
            return $value;
        }
        throw new ValidatorException('Invalid choice value set: ' . htmlspecialchars((string)$value));
    }
}
