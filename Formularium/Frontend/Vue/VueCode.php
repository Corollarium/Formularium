<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_bool;
use Formularium\Datatype\Datatype_number;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Model;

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
    protected $fieldModelVariable = '';

    /**
     * Extra props.
     *
     * @var array
     */
    protected $extraProps = [];

    /**
     * extra data fields
     *
     * @var string[]
     */
    protected $extraData = [];

    /**
     * The list of imports to add: import 'key' from 'value'
     *
     * @var string[]
     */
    protected $imports = [];
    
    /**
     * @var string[]
     */
    protected $computed = [];

    /**
     * @var string[]
     */
    protected $methods = [];

    /**
     * @var string[]
     */
    protected $other = [];

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
     * @param array $extra Array of props. 'name' and 'type' keys are required for each element.
     *
     * @return  self
     */
    public function appendExtraProp(array $extra): self
    {
        $this->extraProps[] = $extra;

        return $this;
    }

    /**
     * Appends to the `data` field.
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function appendExtraData(string $name, string $value): self
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
    public function mapType(Datatype $type): string
    {
        if ($type instanceof Datatype_number) {
            return 'Number';
        } elseif ($type instanceof Datatype_bool) {
            return 'Boolean';
        }
        return 'String';
    }

    public function props(Model $m): array
    {
        $props = [];
        foreach ($m->getFields() as $field) {
            /**
             * @var Field $field
             */
            if ($field->getRenderable(Framework::VUE_PROP, false)) {
                $p = [
                    'name' => $field->getName(),
                    'type' => $this->mapType($field->getDatatype()),
                ];
                if ($field->getRenderable(Datatype::REQUIRED, false)) {
                    $p['required'] = true;
                }
                $props[] = $p;
            }
        }
        foreach ($this->extraProps as $p) {
            if (!array_key_exists('name', $p)) {
                throw new Exception('Missing prop name');
            }
            $props[] = $p;
        }
        
        return $props;
    }

    /**
     * Generates valid JS code for the props.
     *
     * @param array $props
     * @return string
     */
    protected function serializeProps(array $props): string
    {
        $s = array_map(function ($p) {
            return "'{$p['name']}': { 'type': {$p['type']}" . ($p['required'] ?? false ? ", 'required': true" : '') . " } ";
        }, $props);
        return "{\n        " . implode(",\n        ", $s) . "\n    }";
    }

    /**
     * Generates template data for rendering
     *
     * @param Model $m
     * @param HTMLNode[] $elements $elements
     * @return array
     */
    protected function getTemplateData(Model $m, array $elements): array
    {
        $data = array_merge($m->getDefault(), $m->getData());
        $jsonData = json_encode($data);
        $props = $this->props($m);
        $propsBind = array_map(
            function ($p) {
                return 'v-bind:' . $p . '="model.' . $p . '"';
            },
            array_keys($props)
        );

        $templateData = [
            'jsonData' => $jsonData,
            'propsCode' => $this->serializeProps($props),
            'propsBind' => implode(' ', $propsBind),
            'imports' => implode(
                "\n",
                array_map(function ($key, $value) {
                    // TODO: array
                    return "import $key from \"$value\";";
                }, array_keys($this->imports), $this->imports)
            ),
            'computedCode' => implode(
                "\n",
                array_map(function ($key, $value) {
                    // TODO: array
                    return "$key() { $value },";
                }, array_keys($this->computed), $this->computed)
            ),
            'otherData' => implode(
                ",\n",
                expandJS($this->other)
            ) . ",\n",
            'methodsCode' => '{}', // TODO
            'extraData' => implode(
                "\n",
                array_map(function ($key, $value) {
                    return "  $key: $value,";
                }, array_keys($this->extraData), $this->extraData)
            )
        ];

        return $templateData;
    }

    protected function fillTemplate(string $template, array $data, Model $m): string
    {
        foreach ($data as $name => $value) {
            $template = str_replace(
                '{{' . $name . '}}',
                $value,
                $template
            );
        }

        $template = str_replace(
            '{{modelName}}',
            $m->getName(),
            $template
        );
        $template = str_replace(
            '{{modelNameLower}}',
            mb_strtolower($m->getName()),
            $template
        );
        return $template;
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
        $templateData = $this->getTemplateData($m, $elements);

        $viewableTemplate = <<<EOF
{{imports}}

export default {
    {{otherData}}
    data: function () {
        return {{jsonData}};
    },
    computed: { {{computedCode}} },
    props: {{propsCode}},
    methods: {{methodsCode}}
};
EOF;
            
        return $this->fillTemplate(
            $viewableTemplate,
            $templateData,
            $m
        );
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
        $templateData = $this->getTemplateData($m, $elements);

        $viewableTemplate = <<<EOF
    {{otherData}}
    data() {
        return {{jsonData}};
    },
    computed: { {{computedCode}} },
    props: {{propsCode}},
    methods: {{methodsCode}}
EOF;
            
        return $this->fillTemplate(
            $viewableTemplate,
            $templateData,
            $m
        );
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