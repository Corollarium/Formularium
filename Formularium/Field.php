<?php declare(strict_types=1);

namespace Formularium;

use Formularium\CodeGenerator\CodeGenerator;
use Formularium\Exception\Exception;
use Formularium\Factory\DatatypeFactory;

class Field
{
    use ExtradataTrait;

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
     * Array classname => options
     *
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
        return new Field($name, $data['datatype'], $data['renderable'] ?? [], $data['validators'] ?? [], $data['extradata'] ?? []);
    }

    /**
     * @param string $name
     * @param string|Datatype $datatype
     * @param array $renderable
     * @param array $validators
     * @param array $extradata
     */
    public function __construct(string $name, $datatype, array $renderable = [], array $validators = [], array $extradata = [])
    {
        $this->name = $name;
        if ($datatype instanceof Datatype) {
            $this->datatype = $datatype;
        } else {
            $this->datatype = DatatypeFactory::factory($datatype);
        }
        $this->renderable = $renderable;
        $this->validators = array_merge($this->datatype->getValidators(), $validators);
        foreach ($this->validators as $name => $data) {
            if (!is_array($data)) {
                throw new Exception("Validator data for $name must be an array");
            }
        }
        foreach ($extradata as $n => $d) {
            $this->extradata[] = ($d instanceof Extradata) ? $d : new Extradata($d['name'], $d['args']);
        }
    }

    /**
     * @param string $name
     * @param string|Datatype $datatype
     * @param array $renderable
     * @param array $validators
     * @return self
     */
    public static function create(string $name, $datatype, array $renderable = [], array $validators = [], array $extradata = []): self
    {
        return new self($name, $datatype, $renderable, $validators, $extradata);
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
            'renderable' => $this->renderable,
            'extradata' => $this->extradata,
        ];
    }

    /**
     * Generates code for this field given a code generator.
     *
     * @param CodeGenerator $codeGenerator
     * @return string|string[]
     */
    public function getCodeGeneratorFieldDeclaration(CodeGenerator $codeGenerator)
    {
        return $codeGenerator->field($this);
    }
}
