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

    public function __construct($typename = 'choice', $basetype = 'choice')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        throw new ValidatorException('Not implemented');
    }

    public function validate($value, Field $f)
    {
        if (!is_string($value) && !is_int($value)) {
            throw new ValidatorException('Invalid choice value ' . htmlspecialchars($value));
        }
        if ($value || in_array($value, $this->choices)) {
            return $value;
        }
        throw new ValidatorException('Invalid choice value set: ' . htmlspecialchars($value));
    }
}
