<?php declare(strict_types=1);

namespace Formularium;

use Formularium\CodeGenerator\GraphQL\CodeGenerator;
use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;

/**
 * Abstract base class for all datatypes.
 */
abstract class Datatype
{
    use DatatypeRandomTrait;

    /**
     * Must be present in data, but may be empty.
     */
    public const REQUIRED = "required";

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $basetype;

    protected function __construct(string $name = '', string $basetype = '')
    {
        $this->name = $name;
        $this->basetype = $basetype;
    }

    /**
     * Formats field to look prettier. Useful for formatting numbers with commas, ISO dates in
     * locale, etc. Override if necessary.
     *
     * @codeCoverageIgnore
     * @param mixed $value
     * @return mixed
     */
    public function format($value)
    {
        return $value;
    }

    /**
     * Checks if $value is a valid value for this datatype considering the validators.
     *
     * @param mixed $value
     * @param Model $model The entire model, if your field depends on other things of the model. may be null.
     * @throws Exception If invalid, with the message.
     * @return mixed The validated value.
     */
    abstract public function validate($value, ?Model $model = null);

    /**
     * Returns a random valid value for this datatype, considering the validators
     *
     * @param array $validators
     * @throws Exception If cannot generate a random value.
     * @return mixed
     */
    abstract public function getRandom(array $validators = []);

    public function getCodeGeneratorDatatypeDeclaration(CodeGenerator $codeGenerator): string
    {
        return $codeGenerator->datatypeDeclaration($this);
    }

    /**
     * Returns the suggested Laravel Database type for this datatype.
     *
     * @return string
     */
    abstract public function getLaravelSQLType(string $name, array $options = []): string;

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

    public function getDocumentation(): string
    {
        return '';
    }

    public function getMetadata(): Metadata
    {
        return new Metadata(
            $this->getName(),
            $this->getDocumentation() .
                "\n\nRandom value example: " . var_export($this->getRandom(), true),
            []
        );
    }
}
