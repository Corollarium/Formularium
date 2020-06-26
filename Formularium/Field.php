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
    protected $extensions;

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
        return new Field($name, $data['datatype'], $data['extensions'] ?? [], $data['validators'] ?? []);
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * @param string|Datatype $datatype
     * @param array $extensions
     * @param array $validators
     */
    public function __construct(string $name, $datatype, array $extensions = [], array $validators = [])
    {
        $this->name = $name;
        if ($datatype instanceof Datatype) {
            $this->datatype = $datatype;
        } else {
            $this->datatype = Datatype::factory($datatype);
        }
        $this->extensions = $extensions;
        $this->validators = $validators;
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
     * @param string $name
     * @return array
     */
    public function getValidatorOption(string $name): array
    {
        return $this->validators[$name] ?? [];
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getExtension(string $name, $default)
    {
        return $this->extensions[$name] ?? $default;
    }
}
