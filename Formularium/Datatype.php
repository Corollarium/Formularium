<?php

namespace Formularium;

use Formularium\Exception\Exception;

abstract class Datatype
{
    use DatatypeRandomTrait;

    public const REQUIRED = "required";

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $basetype;


    /**
     * Factory.
     *
     * @param string $datatype
     * @return Datatype
     */
    public static function factory(string $datatype): Datatype
    {
        $class = "\\Formularium\\Datatype\\Datatype_$datatype";
        if (!class_exists($class)) {
            $class = "\\Datatype_$datatype";
            if (!class_exists($class)) {
                $class = "$datatype";
            }
            if (!class_exists($class)) {
                throw new Exception("Invalid datatype $datatype");
            }
        }
        return new $class();
    }

    protected function __construct(string $name = '', string $basetype = '')
    {
        $this->name = $name;
        $this->basetype = $basetype;
    }

    /**
     * Formats field to look prettier. Useful for formatting numbers with commas, ISO dates in
     * locale, etc.
     *
     * @param mixed $value
     * @param Field $field
     * @return mixed
     */
    public function format($value, Field $field)
    {
        return $value;
    }

    /**
     * Checks if $value is a valid value for this datatype considering the validators.
     *
     * @param mixed $value
     * @param Field $field
     * @throws Exception If invalid, with the message.
     * @return mixed
     */
    abstract public function validate($value, Field $field);

    /**
     * Returns a random valid value for this datatype, considering the validators
     *
     * @param array $validators
     * @throws Exception If cannot generate a random value.
     * @return mixed
     */
    abstract public function getRandom(array $validators = []);

    /**
     * Returns a default value. Used to build new editable forms, for example.
     *
     * @return mixed
     */
    public function getDefault()
    {
        return '';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBasetype(): string
    {
        return $this->basetype;
    }
}
