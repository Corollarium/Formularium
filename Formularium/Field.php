<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\Exception;

class Field
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Datatype
     */
    protected $datatype;

    /**
     * @var array
     */
    protected $renderable;

    /**
     * @var array
     */
    protected $validators;

    public static function getFromData(string $name, array $data) : Field
    {
        if (!$name) {
            throw new Exception("Missing name in fields");
        }
        if (!array_key_exists('datatype', $data)) {
            throw new Exception("Missing type in field data for $name");
        }
        return new Field($name, $data['datatype'], $data['renderable'] ?? [], $data['validators'] ?? []);
    }

    /**
     * @param string $name
     * @param string|Datatype $datatype
     * @param array $renderable
     * @param array $validators
     */
    public function __construct(string $name, $datatype, array $renderable = [], array $validators = [])
    {
        $this->name = $name;
        if ($datatype instanceof Datatype) {
            $this->datatype = $datatype;
        } else {
            $this->datatype = DatatypeFactory::factory($datatype);
        }
        $this->renderable = $renderable;
        $this->validators = $validators;
        foreach ($this->validators as $name => $data) {
            if (!is_array($data)) {
                throw new Exception("Validator data for $name must be an array");
            }
        }
    }

    /**
     * @param string $name
     * @param string|Datatype $datatype
     * @param array $renderable
     * @param array $validators
     * @return self
     */
    public function create(string $name, $datatype, array $renderable = [], array $validators = []): self
    {
        return new self($name, $datatype, $renderable, $validators);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDatatype(): Datatype
    {
        return $this->datatype;
    }

    public function getValidators(): array
    {
        return $this->validators;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getValidator(string $name, $default = [])
    {
        return $this->validators[$name] ?? $default;
    }

    /**
     * Get option value from a validator.
     *
     * @param string $validator The validator name.
     * @param string $option The validation option.
     * @param mixed $default The default value.
     * @return mixed The option value or the default value if there is none.
     */
    public function getValidatorOption(string $validator, string $option = 'value', $default = null)
    {
        return $this->validators[$validator][$option] ?? $default;
    }

    /**
     * Sets an option value
     *
     * @param string $validator
     * @param string $option
     * @param mixed $value
     * @return self
     */
    public function setValidatorOption(string $validator, string $option, $value): self
    {
        $this->validators[$validator][$option] = $value;
        return $this;
    }

    public function getRenderables(): array
    {
        return $this->renderable;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getRenderable(string $name, $default)
    {
        return $this->renderable[$name] ?? $default;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'datatype' => $this->datatype->getName(),
            'validators' => $this->validators,
            'renderable' => $this->renderable
        ];
    }
}
