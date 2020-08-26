<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\Factory\DatatypeFactory;

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

    /**
     * @var array
     */
    protected $metadata;

    public static function getFromData(string $name, array $data) : Field
    {
        if (!$name) {
            throw new Exception("Missing name in fields");
        }
        if (!array_key_exists('datatype', $data)) {
            throw new Exception("Missing type in field data for $name");
        }
        return new Field($name, $data['datatype'], $data['renderable'] ?? [], $data['validators'] ?? [], $data['metadata'] ?? []);
    }

    /**
     * @param string $name
     * @param string|Datatype $datatype
     * @param array $renderable
     * @param array $validators
     * @param array $metadata
     */
    public function __construct(string $name, $datatype, array $renderable = [], array $validators = [], array $metadata = [])
    {
        $this->name = $name;
        if ($datatype instanceof Datatype) {
            $this->datatype = $datatype;
        } else {
            $this->datatype = DatatypeFactory::factory($datatype);
        }
        $this->renderable = $renderable;
        $this->validators = $validators;
        $this->metadata = $metadata;
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
    public static function create(string $name, $datatype, array $renderable = [], array $validators = [], array $metadata = []): self
    {
        return new self($name, $datatype, $renderable, $validators, $metadata);
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

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getMetadataValue(string $name, $default)
    {
        return $this->metadata[$name] ?? $default;
    }

    /**
     * Sets an option value
     *
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function setMetadataValue(string $name, $value): self
    {
        $this->metaata[$name] = $value;
        return $this;
    }

    public function toGraphqlQuery(): string
    {
        return $this->datatype->getGraphqlField($this->getName());
    }

    public function toGraphqlTypeDefinition(): string
    {
        $renderable = array_map(
            function ($name, $value) {
                $v = $value;
                if (is_string($value)) {
                    $v = '"' . str_replace('"', '\\"', $value) . '"';
                }
                return ' ' . $name . ': ' . $v;
            },
            array_keys($this->renderable),
            $this->renderable
        );

        return $this->getName() . ': ' . $this->datatype->getGraphqlType() .
            ($this->getValidator(Datatype::REQUIRED, false) ? '' : '!') .
            // TODO: validators
            ($this->renderable ? " @renderable(\n" . join("\n", $renderable) . "\n)" : '') .
            "\n";
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'datatype' => $this->datatype->getName(),
            'validators' => $this->validators,
            'renderable' => $this->renderable,
            'metadata' => $this->metadata,
        ];
    }
}
