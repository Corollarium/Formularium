<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_bool;
use Formularium\Datatype\Datatype_number;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Model;

use function Safe\json_encode;

/**
 * Converts an array to a JS object. Unlike JSON this does serialize
 * data to strings, and allow functions, etc. If you need to add
 * strings they are expected to be previously quoted with " or '
 *
 * @param array $data
 * @return array
 */
function expandJS(array $data): array
{
    return array_map(function ($key, $value) {
        return "$key" .
            (
                is_array($value) ?
                ': {' . implode(",\n", expandJS($value)) . '}' :
                ($value ? ':' . $value : '')
            );
    }, array_keys($data), $data);
}

class VueCode
{

    /**
     * Appended to the field variable names to handle models stored in an object field.
     *
     * Allows you to declare the model like this:
     *
     * data() {
     *   return {
     *       model: model,
     *   };
     * },
     *
     * @var string
     */
    public $fieldModelVariable = '';

    /**
     * Extra props.
     *
     * @var array
     */
    public $extraProps = [];

    /**
     * extra data fields
     *
     * @var string[]
     */
    public $extraData = [];

    /**
     * The list of imports to add: import 'key' from 'value'
     *
     * @var string[]
     */
    public $imports = [];

    /**
     * @var string[]
     */
    public $computed = [];

    /**
     * @var string[]
     */
    public $methods = [];

    /**
     * @var string[]
     */
    public $other = [];

    /**
     * @var VueCodeAbstractRenderer
     */
    public $renderer;

    public function __construct(string $rendererClass = VueCodeDictRenderer::class)
    {
        $this->renderer = new $rendererClass($this);
    }

    /**
     * @param string $name
     * @param string $code
     * @return self
     */
    public function appendMethod($name, $code): self
    {
        $this->methods[$name] = $code;
        return $this;
    }

    /**
     * @param string $name
     * @param string $code
     * @return self
     */
    public function appendOther($name, $code): self
    {
        $this->other[$name] = $code;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraProps(): array
    {
        return $this->extraProps;
    }

    /**
     *
     * @param array $extraProps
     *
     * @return  self
     */
    public function setExtraProps(array $extraProps): self
    {
        $this->extraProps = $extraProps;

        return $this;
    }

    /**
     *
     * @param string $name The prop name.
     * @param array $extra Array of props. 'name' and 'type' keys are required for each element.
     *
     * @return  self
     */
    public function appendExtraProp(string $name, array $extra): self
    {
        $this->extraProps[$name] = $extra;

        return $this;
    }

    /**
     * Appends to the `data` field.
     *
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function appendExtraData(string $name, $value): self
    {
        $this->extraData[$name] = $value;
        return $this;
    }

    /**
     * The list of imports to add: import 'key' from 'value'
     *
     * @param string $key
     * @param string $value
     * @return self
     */
    public function appendImport(string $key, string $value): self
    {
        $this->imports[$key] = $value;

        return $this;
    }

    /**
     * The list of computed to add: $ke() => $code
     *
     * @param string $key
     * @param string $code
     * @return self
     */
    public function appendComputed(string $key, string $code): self
    {
        $this->computed[$key] = $code;

        return $this;
    }

    /**
     * Get appended to the field variable names to handle models stored in an object field.
     *
     * @return  string
     */
    public function getFieldModelVariable(): string
    {
        return $this->fieldModelVariable;
    }

    /**
     * Set appended to the field variable names to handle models stored in an object field.
     *
     * @param  string  $fieldModelVariable  Appended to the field variable names to handle models stored in an object field.
     *
     * @return  self
     */
    public function setFieldModelVariable(string $fieldModelVariable): self
    {
        $this->fieldModelVariable = $fieldModelVariable;

        return $this;
    }

    /**
     * Converts a Datatype to a JS type
     *
     * @param Datatype $type
     * @return string
     */
    public function mapTypeToJS(Datatype $type): string
    {
        if ($type instanceof Datatype_number) {
            return 'Number';
        } elseif ($type instanceof Datatype_bool) {
            return 'Boolean';
        } elseif ($type->getBasetype() == 'relationship') { // TODO this is crappy, comes from modelarium
            return 'Object';
        }
        return 'String';
    }

    /**
     * Generates the javascript code.
     *
     * @param Model $m
     * @param HTMLNode[] $elements
     * @return string
     */
    public function toScript(Model $m, array $elements)
    {
        return $this->renderer->toScript($m, $elements);
    }

    /**
     * Generates the javascript code.
     *
     * @param Model $m
     * @param HTMLNode[] $elements
     * @return string
     */
    public function toVariable(Model $m, array $elements)
    {
        return $this->renderer->toVariable($m, $elements);
    }

    /**
     * Get the value of other
     * @return array
     */
    public function &getOther(): array
    {
        return $this->other;
    }
}
